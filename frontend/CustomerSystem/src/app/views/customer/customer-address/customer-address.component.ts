import { Component, Input, OnInit, Output } from '@angular/core';
import { EventEmitter } from '@angular/core';

@Component({
  selector: 'app-customer-address',
  templateUrl: './customer-address.component.html',
  styleUrls: ['./customer-address.component.css']
})
export class CustomerAddressComponent implements OnInit {

  @Output() closeAddress: EventEmitter<boolean> = new EventEmitter();
  @Input() idAddress: number;

  constructor() { }

  ngOnInit(): void {
      if(this.idAddress){
        alert(this.idAddress);
      }
  }

  onSaveAddress(){
    this.closeAddress.emit(true);
  }

  onClose(){
    this.closeAddress.emit(true);
  }
  
  

}
