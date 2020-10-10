import { Injectable } from '@angular/core';
import { environment } from '../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor() { }

  

  public getUrlCustomerService() {
    if (environment.dev) {
      return "http://localhost:8006";
    } else if (environment.test) {
      return "http://localhost:8006";
    } else if (environment.production) {
      return "http://localhost:8006";
    }
  }

  public getUrlUserService() {
    if (environment.dev) {
      return "http://localhost:8005";
    } else if (environment.test) {
      return "http://localhost:8005";
    } else if (environment.production) {
      return "http://localhost:8005";
    }
  }

}
