import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';
import { Pagination } from '../models/pagination';
import { AuthenticateService } from './authenticate.service';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Address } from '../models/address';

@Injectable({
  providedIn: 'root'
})
export class AddressService {

  constructor(private router: Router, private http: HttpClient, private authenticate: AuthenticateService, private api: ApiService) {

  }

  public postAddress(address: Address): Promise<any> {

    return new Promise<any>((resolve, reject) => {
      this.http.post(`${this.api.getUrlCustomerService()}/address/v1/`, address, { headers: this.authenticate.getHeader() })
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

  public putAddress(address: Address): Promise<any> {

    return new Promise<any>((resolve, reject) => {
      this.http.put(`${this.api.getUrlCustomerService()}/address/v1/`, address, { headers: this.authenticate.getHeader() })
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

  public deleteAddress(id: number): Promise<any> {

    return new Promise<any>((resolve, reject) => {
      this.http.delete(`${this.api.getUrlCustomerService()}/address/v1/?Id=${id}`, { headers: this.authenticate.getHeader() })
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

  public getAddress(id: number): Promise<Address> {

    return new Promise<Address>((resolve, reject) => {
      this.http.get<Address>(`${this.api.getUrlCustomerService()}/address/v1/?Id=${id}`,
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

  public getAddresses(RecordsByPage: number, Page: number, idCustomer: number): Promise<Pagination<Address>> {

    return new Promise<Pagination<Address>>((resolve, reject) => {
      this.http.get<Pagination<Address>>(`${this.api.getUrlCustomerService()}/addresses/v1/?IdCustomer=${idCustomer}&RecordsByPage=${RecordsByPage}&Page=${Page}`, { headers: this.authenticate.getHeader() })
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
