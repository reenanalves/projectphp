import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
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

  constructor(private customerService: CustomerService, private formBuilder: FormBuilder, private router: Router, private activatedRoute: ActivatedRoute) {
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
      this.customerService.getCustomer(id).
        then(value => {
          this.isEditing = true;
          this.customer = value;
        }).
        catch(error => {
          alert("Erro ao carregar cliente!");
        });
    }

  }

  onSaveCustomer() {
    try {

      if(!this.form.valid){
        return;
      }

      if (!this.isEditing) {
        this.customer.status = 1;
        this.customerService.postCustomer(this.customer).
          then(value => {
            alert("Cliente cadastrado com sucesso!");
            this.router.navigateByUrl(`/customer/${value.Id}`);
          }).
          catch(error => {
            this.error(error.error);
          });
      } else {
        this.customerService.putCustomer(this.customer).
          then(value => {
            alert("Cliente salvo com sucesso!");
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
    alert(error);
  }

}
