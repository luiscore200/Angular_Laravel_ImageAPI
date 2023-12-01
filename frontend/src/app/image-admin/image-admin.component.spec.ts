import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ImageAdminComponent } from './image-admin.component';

describe('ImageAdminComponent', () => {
  let component: ImageAdminComponent;
  let fixture: ComponentFixture<ImageAdminComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ImageAdminComponent]
    });
    fixture = TestBed.createComponent(ImageAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
