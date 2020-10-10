import { Component, OnDestroy, OnInit } from '@angular/core';
import { EventEmitter } from '@angular/core';
import { Address } from '../../../models/address';
import { Pagination } from '../../../models/pagination';
import { AddressService } from '../../../services/address.service';

@Component({
  selector: 'app-customer-address-list',
  templateUrl: './customer-address-list.component.html',
  styleUrls: ['./customer-address-list.component.css']
})
export class CustomerAddressListComponent implements OnInit {

  isShowAddress: boolean = false;
  idAddressEditing : number = 0;

  page : number = 0;
  recordsByPage : number = 10;
  addresses : Pagination<Address> = new Pagination<Address>();

  constructor(private addressService : AddressService) { }
  

  ngOnInit(): void {
    this.getAddressess(1)
  }

  getAddressess(page){

    this.addressService.getAddresses(this.recordsByPage, page).
    then(value => {
      this.page = page;
      this.addresses = value;
    }).catch(error => {

    });
  }

  nextPage(){
    if(this.addresses.NextPage > this.page){
      this.getAddressess(this.addresses.NextPage);
    }
  }

  priorPage(){
    if(this.addresses.PriorPage < this.page){
      this.getAddressess(this.addresses.PriorPage);
    }
  }

  onEditAddress(id){
    this.idAddressEditing = id;
    this.isShowAddress = true;
  }

  onNewAddress() {
    this.idAddressEditing = undefined;
    this.isShowAddress = true;
  }

  onHideAddress(event){
    this.isShowAddress = !event;
  }
}
