import { Component, OnInit } from '@angular/core';
import { ImageService } from '../image.service';


@Component({
  selector: 'app-image-admin',
  templateUrl: './image-admin.component.html',
  styleUrls: ['./image-admin.component.css']
})
export class ImageAdminComponent implements OnInit {
  imageUrl: any;
  imagesUrl!:[any]; 

  constructor(private imageService: ImageService) { }

  ngOnInit(): void {
    //this.loadImages("9");
     this.loadAllImages();
  }

  loadImages(objeto:string): void {
    this.imageService.getImage(objeto).subscribe(
      (data) => {
        this.handleResponse(data);
      },
      (error) => {
        console.error(error);
      }
    );
  }

  loadAllImages():void{
    this.imageService.getAllImage().subscribe(
      (data) => {
        this.handleResponse2(data);
      },
      (error) => {
        console.error(error);
      }
    );
  }

  

  handleResponse(data:any){
    console.log(data)
    this.imageUrl= data;
  }

  handleResponse2(data:[any]){
    console.log(data)
    this.imagesUrl= data;
  }


}


