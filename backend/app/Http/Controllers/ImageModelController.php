<?php

namespace App\Http\Controllers;

use App\Models\imageModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;



class ImageModelController extends Controller
{
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }




        $filename="";
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/post', $filename);
        }else{
            $filename=null;
        }

        
        try{
            $image= new imageModel();
            $image->title=$request->title;
            $image->image = $filename;
            $result=$image->save();
            if($result){
                return Response()->json(['success'=>true]);
            }else{
                return Response()->json(['success'=>false]);
            }
        }catch(Exception $e){
            return Response()->json(['error'=>$e]);
        }
        
    }

    public function index(){
        $images = imageModel::all();

        if($images){
            $infoArray = [];
    
            foreach ($images as $image) {
                $imageUrl = asset('storage/post/' . $image->image);
                $infoArray[] = ['image' => $image, 'url' => $imageUrl];
            }
        
            return Response()->json($infoArray);

        }else{
            return Response()->json(['msg'=>'images not found'],404);

        }
      
    }

    public function getInfo($id){
        $images= imageModel::findOrFail($id);
        if($images){
            $imageUrl = asset('storage/post/' . $images->image);
            return Response()->json(['image'=>$images,'url'=>$imageUrl]);
        }else{

            return Response()->json(['msg'=>'image not found'],404);
        }
    
    }



    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        //  return response()->json($request->all());
       
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }



        $images= imageModel::findOrFail($id);
        if($request->hasFile('image')){
            File::delete(storage_path('app/public/post/' . $images->image));

            $file=$request->file('image');
            $filename=time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/post', $filename); 
            $images->image = $filename;
        }

        $images->title=$request->title;
        $result= $images->save();

        if($result){
            return Response()->json(['success'=>true]);
        }else{
            return Response()->json(['success'=>false]);
        }
    }

    public function delete($id){
        $image= imageModel::findOrFail($id);
        if($image){
            File::delete(storage_path('app/public/post/' . $image->image)); 
            $result= $image->delete();
            if($result){
                return Response()->json(['success'=>true]);
            }else{
                return Response()->json(['success'=>false]);
            }
        }else{
            return Response()->json(['msg'=>'not found'],404);
        }
      
    }

    public function show($id)
    {
        $image = imageModel::findOrFail($id);

        if ($image) {
            $path = storage_path('app/public/post/' . $image->image);

            // Verificar si la imagen existe en el almacenamiento
            if (File::exists($path)) {
                $file = File::get($path);
                $type = File::mimeType($path);

                // Retornar la vista de la imagen
                return Response::make($file, 200)->header("Content-Type", $type);
            } else {
                return Response()->json(['msg' => 'Imagen no encontrada'], 404);
            }
        } else {
            return Response()->json(['msg' => 'Registro no encontrado'], 404);
        }
    }



      
}
