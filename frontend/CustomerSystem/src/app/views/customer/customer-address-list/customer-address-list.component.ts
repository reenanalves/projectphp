import { Component, Input, OnDestroy, OnInit } from '@angular/core';
import { EventEmitter } from '@angular/core';
import { NgxSpinnerService } from 'ngx-spinner';
import { ToastrService } from 'ngx-toastr';
import { Address } from '../../../models/address';
import { Pagination } from '../../../models/pagination';
import { AddressService } from '../../../services/address.service';

@Component({
  selector: 'app-customer-address-list',
  templateUrl: './customer-address-list.component.html',
  styleUrls: ['./customer-address-list.component.css']
})
export class CustomerAddressListComponent implements OnInit {

  @Input() idCustomer: number;

  isShowAddress: boolean = false;
  idAddressEditing : number = 0;

  page : number;
  recordsByPage : number = 10;
  addresses : Pagination<Address> = new Pagination<Address>();

  constructor(private toastr: ToastrService, private spinner: NgxSpinnerService, private addressService : AddressService) { }
  

  ngOnInit(): void {
    this.page = 1;
    this.getAddressess(1)
  }

  getAddressess(page){
    this.spinner.show();
    this.addressService.getAddresses(this.recordsByPage, page, this.idCustomer).
    then(value => {
      this.page = page;
      this.addresses = value;
      this.spinner.hide();
    }).catch(error => {
      this.addresses = new Pagination<Address>();
      this.spinner.hide();
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

  notification(type, title, message){
    if(type == "s"){
      this.toastr.success(message, title);
    }
    else if (type == "e"){
      this.toastr.warning(message, title);
    }
  }

  onDeleteAddress(id){
    this.spinner.show();
    this.addressService.deleteAddress(id).then(value =>{
      this.notification("s", "Notificação", "Endereço deletado com sucesso!" );
      this.spinner.hide();
      this.getAddressess(this.page);
    }).catch(error => {
      this.spinner.hide();
      this.notification("e", "Erro", "Não foi possível deletar este endereço!" );
    });
  }

  onNewAddress() {
    this.idAddressEditing = undefined;
    this.isShowAddress = true;
  }

  onHideAddress(event){
    this.isShowAddress = !event;
    this.getAddressess(this.page);
  }

  
}
