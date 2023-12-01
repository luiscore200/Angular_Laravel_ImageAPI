import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ImageAdminComponent } from './image-admin/image-admin.component';

const routes: Routes = [
  { path: '', redirectTo: 'index', pathMatch: 'full' },
{
  path: 'index',
  component: ImageAdminComponent
 
},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
