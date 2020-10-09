import { Injectable } from '@angular/core';
import { environment } from '../environments/environment';
import { AuthenticateService } from './services/authenticate.service';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private authenticate: AuthenticateService) { }

  getHeader(): Promise<any> {

    let headers: Headers = new Headers();

    return new Promise<any>((resolve, reject) => {

      headers.append("Token", this.authenticate.getToken());
      headers.append("Content-Type", "application/json");

      resolve(headers);

    });

  }

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
