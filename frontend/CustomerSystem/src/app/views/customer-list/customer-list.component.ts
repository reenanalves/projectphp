import { Component, OnInit } from '@angular/core';
import { Customer } from '../../models/customer';
import { Pagination } from '../../models/pagination';
import { CustomerService } from '../../services/customer.service';

@Component({
  selector: 'app-customer-list',
  templateUrl: './customer-list.component.html',
  styleUrls: ['./customer-list.component.css']
})
export class CustomerListComponent implements OnInit {

  page : number = 0;
  recordsByPage : number = 10;
  customers : Pagination<Customer> = new Pagination<Customer>();

  constructor(private customerService : CustomerService) { }

  ngOnInit(): void {
    this.getCustomers(1);
  }

  getCustomers(page){

    this.customerService.getCustomers(this.recordsByPage, page).
    then(value => {
      this.page = page;
      this.customers = value;
    }).catch(error => {

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
