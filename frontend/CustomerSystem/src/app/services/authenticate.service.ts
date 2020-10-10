import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';
import { Authenticate } from '../models/authenticate';
import { User } from '../models/user';

@Injectable({
  providedIn: 'root'
})
export class AuthenticateService {

  private token: string;
  private user: User;

  constructor(private api: ApiService, private http: HttpClient) { }



  getHeader(): HttpHeaders {

    let headers: HttpHeaders = new HttpHeaders();
    if (this.getToken()) {
      headers = headers.set("Token", this.getToken());
    }
    headers = headers.set("Content-Type", "application/json");

    return headers;

  }

  getToken() {
    return this.token;
  }

  userIsLogged() {
    
    let token = localStorage.getItem("token");
    let logged = localStorage.getItem("logged");

    this.token = token;

    if(token && logged == "true"){
      return this.tokenValidate().then(value => {
        return true;
      }).catch(error => {     
        this.logout();
        return false;
      });
    }else{
      return false;
    }

  }

  logout() {
    localStorage.removeItem("token");
    localStorage.removeItem("logged");
    window.location.reload();
  }

  authenticate(user, pass): Promise<any> {
    return new Promise<any>((resolve, reject) => {
      this.http.post<Authenticate>(`${this.api.getUrlUserService()}/user/v1/Authenticate`, { "user": user, "pass": pass }, { headers: this.getHeader() })
        .subscribe((data) => {
          
          this.token = data.Token;
          localStorage.setItem("token", this.token);
          localStorage.setItem("logged", "true");

          resolve(true);

        },
          ((error) => {
            reject("Login ou senha incorretos!");
          }));
    });
  }

  tokenValidate(): Promise<any> {

    return new Promise<any>((resolve, reject) => {
      this.http.post<User>(`${this.api.getUrlUserService()}/user/v1/TokenValidate`, null, { headers: this.getHeader() })
        .subscribe((data) => {
          this.user = data;
          resolve(true);
        },
          ((error) => {
            reject(false);
          }));
    });
  }


}
