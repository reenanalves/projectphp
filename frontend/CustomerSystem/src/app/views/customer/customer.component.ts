import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgxSpinnerService } from 'ngx-spinner';
import { ToastrService } from 'ngx-toastr';
import { Customer } from '../../models/customer';
import { CustomerService } from '../../services/customer.service';

@Component({
  selector: 'app-customer',
  templateUrl: './customer.component.html',
  styleUrls: ['./customer.component.css']
})
export class CustomerComponent implements OnInit {

  customer: Customer = new Customer();
  isEditing: boolean = false;
  form : FormGroup;

  constructor(private toastr: ToastrService, private customerService: CustomerService, private spinner: NgxSpinnerService, private formBuilder: FormBuilder, private router: Router, private activatedRoute: ActivatedRoute) {
    this.form = this.formBuilder.group({
      name: [null, [Validators.required]],
      birthday: [null, Validators.required],
      document_cpf: [null, Validators.required],
      document_rg: [null, Validators.required],
      phone: [null, Validators.required],
    });
  }

  ngOnInit(): void {

    let id = this.activatedRoute.snapshot.params.id;

    if (id) {
      this.spinner.show();
      this.customerService.getCustomer(id).
        then(value => {
          this.isEditing = true;
          this.customer = value;
          this.spinner.hide();
        }).
        catch(error => {
          this.spinner.hide();
          this.notification('e', 'Erro', 'Não foi possível carregar os clientes!');
        });
    }

  }

  notification(type, title, message){
    
    if(type == "s"){
      this.toastr.success(message, title);
    }
    else if (type == "e"){
      this.toastr.warning(message, title);
    }
  }

  onSaveCustomer() {
    try {

      if(!this.form.valid){
        return;
      }
      this.spinner.show();
      if (!this.isEditing) {
        this.customer.status = 1;
        this.customerService.postCustomer(this.customer).
          then(value => {            
            this.spinner.hide();
            this.notification('s', 'Notificação', 'Cliente cadastrado com sucesso!');
            this.router.navigateByUrl(`/customer/${value.Id}`);
          }).
          catch(error => {
            this.error(error.error);
          });
      } else {
        this.customerService.putCustomer(this.customer).
          then(value => {            
            this.spinner.hide();
            this.notification('s', 'Notificação', 'Cliente salvo com sucesso!');
          }).
          catch(error => {
            this.error(error.error);
          });
      }

    } catch (e) {      
      this.error(e);
    }
  }

  error(error){
    this.spinner.hide();
    this.notification('e', 'Erro', error);
  }

}
