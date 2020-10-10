import { Component, OnInit } from '@angular/core';
import { Customer } from '../../models/customer';
import { Pagination } from '../../models/pagination';
import { CustomerService } from '../../services/customer.service';
import {  NgxSpinnerService } from 'ngx-spinner';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-customer-list',
  templateUrl: './customer-list.component.html',
  styleUrls: ['./customer-list.component.css']
})
export class CustomerListComponent implements OnInit {

  page : number;
  recordsByPage : number = 10;
  customers : Pagination<Customer> = new Pagination<Customer>();

  constructor(private toastr: ToastrService, private customerService : CustomerService, private spinner: NgxSpinnerService) { }

  ngOnInit(): void {    
    this.page = 1;
    this.getCustomers(1);
  }

  onDeleteCustomer(id){
    this.spinner.show();
    this.customerService.deleteCustomer(id).then(value =>{      
      this.spinner.hide();
      this.notification("s", "Notificação", "Cliente deletado com sucesso!" );        
      this.getCustomers(this.page);
    }).catch(error => {
      this.spinner.hide();
      this.notification("s", "Notificação", "Não foi possível deletar este cliente!" );              
    });
  }

  notification(type, title, message){
    if(type == "s"){
      this.toastr.success(message, title);
    }
    else if (type == "e"){
      this.toastr.warning(message, title);
    }
  }

  getCustomers(page){
    this.spinner.show();
    this.customerService.getCustomers(this.recordsByPage, page).
    then(value => {
      this.page = page;
      this.customers = value;
      this.spinner.hide();
    }).catch(error => {
      this.spinner.hide();
      this.customers = new Pagination<Customer>();
    });
  }

  nextPage(){
    if(this.customers.NextPage > this.page){
      this.getCustomers(this.customers.NextPage);
    }
  }

  priorPage(){
    if(this.customers.PriorPage < this.page){
      this.getCustomers(this.customers.PriorPage);
    }
  }

}
