import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Customer } from '../models/customer';
import { GetCustomer } from '../responses/getcustomer';
import { GetCustomers } from '../responses/getcustomers';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class CustomerService {

  constructor(private http: HttpClient, private api: ApiService) {

  }

  public postCustomer(customer: Customer): Promise<GetCustomer> {

    return new Promise<GetCustomer>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.post(`${this.api.getUrlCustomerService()}/customer/v1/`, customer, { headers: headers })
          .subscribe((data) => {
            resolve(data);
          }, ((error) => { reject(error); }));
      });
    });
  }

  public putCustomer(customer: Customer): Promise<GetCustomer> {

    return new Promise<GetCustomer>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.put(`${this.api.getUrlCustomerService()}/customer/v1/`, customer, { headers: headers })
          .subscribe((data) => {
            resolve(data);
          }, ((error) => { reject(error); }));
      });
    });

  }

  public deleteCustomer(id : number): Promise<GetCustomer> {

    return new Promise<GetCustomer>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.delete(`${this.api.getUrlCustomerService()}/customer/v1/?Id=${id}`, { headers: headers })
          .subscribe((data) => {
            resolve(data);
          }, ((error) => { reject(error); }));
      });
    });

  }

  public getCustomer(id: number): Promise<GetCustomer> {

    return new Promise<GetCustomer>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.get<GetCustomer>(`${this.api.getUrlCustomerService()}/customer/v1/?Id=${id}`, { headers: headers })
          .subscribe((data) => {
            resolve(data);
          }, ((error) => { reject(error); }));
      });
    });

  }

  public getCustomers(RecordsByPage: number, Page: number): Promise<GetCustomers> {

    return new Promise<GetCustomer>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.get<GetCustomer>(`${this.api.getUrlCustomerService()}/customers/v1/?RecordsByPage=${RecordsByPage}&Page=${Page}`, { headers: headers })
          .subscribe((data) => {
            resolve(data);
          }, ((error) => { reject(error); }));
      });
    });

  }

}
