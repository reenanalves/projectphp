import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Customer } from '../models/customer';
import { ApiService } from '../api.service';
import { Pagination } from '../models/pagination';
import { AuthenticateService } from './authenticate.service';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class CustomerService {

  constructor(private router: Router, private http: HttpClient, private authenticate: AuthenticateService, private api: ApiService) {

  }

  public postCustomer(customer: Customer): Promise<any> {

    return new Promise<any>((resolve, reject) => {
      this.http.post(`${this.api.getUrlCustomerService()}/customer/v1/`, customer, { headers: this.authenticate.getHeader() })
        .subscribe((data) => {
          resolve(data);
        }, ((error) => {

          if (error.status == 401) {
            this.router.navigateByUrl("/login");
          } else {
            reject(error);
          }

        }));
    });
  }

  public putCustomer(customer: Customer): Promise<any> {

    return new Promise<any>((resolve, reject) => {
      this.http.put(`${this.api.getUrlCustomerService()}/customer/v1/`, customer, { headers: this.authenticate.getHeader() })
        .subscribe((data) => {
          resolve(data);
        }, ((error) => {
          if (error.status == 401) {
            this.router.navigateByUrl("/login");
          } else {
            reject(error);
          }
        }));
    });

  }

  public deleteCustomer(id: number): Promise<any> {

    return new Promise<any>((resolve, reject) => {
      this.http.delete(`${this.api.getUrlCustomerService()}/customer/v1/?Id=${id}`, { headers: this.authenticate.getHeader() })
        .subscribe((data) => {
          resolve(data);
        }, ((error) => {
          if (error.status == 401) {
            this.router.navigateByUrl("/login");
          } else {
            reject(error);
          }
        }));
    });

  }

  public getCustomer(id: number): Promise<Customer> {

    return new Promise<Customer>((resolve, reject) => {
      this.http.get<Customer>(`${this.api.getUrlCustomerService()}/customer/v1/?Id=${id}`,
        { headers: this.authenticate.getHeader() })
        .subscribe((data) => {
          resolve(data);
        }, ((error) => {

          if (error.status == 401) {
            this.router.navigateByUrl("/login");
          } else {
            reject(error);
          }

        }));

    });

  }

  public getCustomers(RecordsByPage: number, Page: number): Promise<Pagination<Customer>> {

    return new Promise<Pagination<Customer>>((resolve, reject) => {
      this.http.get<Pagination<Customer>>(`${this.api.getUrlCustomerService()}/customers/v1/?RecordsByPage=${RecordsByPage}&Page=${Page}`, { headers: this.authenticate.getHeader() })
        .subscribe((data) => {
          resolve(data);
        }, ((error) => {
          if (error.status == 401) {
            this.router.navigateByUrl("/login");
          } else {
            reject(error);
          }
        }));
    });

  }

}
