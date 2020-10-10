import { Component, ElementRef, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { AuthenticateService } from '../../services/authenticate.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: 'login.component.html'
})
export class LoginComponent {

  public user: string;
  public pass: string;

  form : FormGroup;

  @ViewChild('userInput') userInput: ElementRef;
  @ViewChild('passInput') passInput: ElementRef;

  constructor(private toastr: ToastrService, private router: Router, private authenticateService: AuthenticateService, private formBuilder: FormBuilder) {
    this.user = "";
    this.pass = "";

    this.form = this.formBuilder.group({
      user: [null, [Validators.required]],
      pass: [null, Validators.required],
    });
  }

  onLogin() {

    if (!this.form.valid) {
      return;
    }

    this.authenticateService.authenticate(this.user, this.pass).then(value => {
      this.notification('s', 'Notificação', "Login efetuado com sucesso!");
      this.router.navigateByUrl("");
    }).catch(error => {      
      this.notification('e', 'Erro', error);
    });
  }

  notification(type, title, message){    
    if(type == "s"){
      this.toastr.success(message,title );
    }
    else if (type == "e"){
      this.toastr.warning(message, title);
    }
  }

  onKeyUser(event) {
    if (event.key == "Enter") {
      if (this.user) {
        this.passInput.nativeElement.focus();
      }
    }
  }

  onKeyPass(event) {
    if (event.key == "Enter") {
      this.onLogin();
    }
  }

}
