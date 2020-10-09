import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class AuthenticateService {

  private token: string;

  constructor(private api: ApiService, private http: HttpClient) { }

  getToken() {
    return this.token;
  }

  userIsLogged(){

  }

  tokenValidate(){
    return new Promise<any>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.post(`${this.api.getUrlUserService()}/user/v1/Authenticate`, { "user": user, "pass": pass }, { headers: headers })
          .subscribe((data) => {

            this.token = data.token;
            localStorage.setItem("token",this.token);
            localStorage.setItem("logged","true");

            resolve(true);            

          },
            ((error) => {
              reject("Login ou senha incorretos!");
            }));
      });
    });
  }

  authenticate(user, pass): Promise<any> {
    return new Promise<any>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.post(`${this.api.getUrlUserService()}/user/v1/Authenticate`, { "user": user, "pass": pass }, { headers: headers })
          .subscribe((data) => {

            this.token = data.token;
            localStorage.setItem("token",this.token);
            localStorage.setItem("logged","true");

            resolve(true);            

          },
            ((error) => {
              reject("Login ou senha incorretos!");
            }));
      });
    });
  }

  updateToken(): Promise<any> {
    return new Promise<any>((resolve, reject) => {
      this.api.getHeader().then((headers) => {
        this.http.post(`${this.api.getUrlUserService()}/user/v1/UpdateToken`,null, { headers: headers })
          .subscribe((data) => {
            resolve(data);
          },
            ((error) => {
              reject(error);
            }));
      });
    });
  }


}
