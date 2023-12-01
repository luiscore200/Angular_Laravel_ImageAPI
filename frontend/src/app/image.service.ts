import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ImageService {

  protected url= "http://127.0.0.1:8000/api"
  constructor(private http:HttpClient) { }

  getImage(objeto:string):Observable<any>{
    return this.http.get<any>(this.url+'/getInfo/'+objeto);
  
  }
  getAllImage():Observable<any>{
    return this.http.get<any>(this.url+'/index');
  
  }
}
