import { Component, ElementRef, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
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

  constructor(private router: Router, private authenticateService: AuthenticateService, private formBuilder: FormBuilder) {
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
      this.router.navigateByUrl("");
    }).catch(error => {
      alert(error);
    });
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
