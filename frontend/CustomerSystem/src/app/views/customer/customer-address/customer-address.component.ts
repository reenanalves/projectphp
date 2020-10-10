import { Component, Input, OnInit, Output } from '@angular/core';
import { EventEmitter } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgxSpinnerService } from 'ngx-spinner';
import { ToastrService } from 'ngx-toastr';
import { Address } from '../../../models/address';
import { AddressService } from '../../../services/address.service';

@Component({
  selector: 'app-customer-address',
  templateUrl: './customer-address.component.html',
  styleUrls: ['./customer-address.component.css']
})
export class CustomerAddressComponent implements OnInit {

  @Output() closeAddress: EventEmitter<boolean> = new EventEmitter();
  @Input() idAddress: number;
  @Input() idCustomer: number;

  form: FormGroup;
  address: Address = new Address();


  constructor(private toastr: ToastrService, private spinner: NgxSpinnerService, private formBuilder: FormBuilder, private addressService: AddressService) {
    this.form = this.formBuilder.group({
      street: [null, [Validators.required]],
      district: [null, Validators.required],
      complement: [null, null],
      number: [null, Validators.required],
      city: [null, Validators.required],
      state: [null, Validators.required],
    });

  }

  ngOnInit(): void {
    if (this.idAddress) {
      this.spinner.show();
      this.addressService.getAddress(this.idAddress).
        then(value => {
          this.address = value;
          this.spinner.hide();
        }).
        catch(error => {
          this.spinner.hide();          
          this.notification("e", "Erro", "Não foi possível carregar o endereço selecionado!" )
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

  onSaveAddress() {

    try {

      if(!this.form.valid){
        return;
      }

      this.spinner.show();

      if (!this.idAddress) {
        this.address.customer_id = this.idCustomer;
        this.address.status = 1;
        this.addressService.postAddress(this.address).
          then(value => {
            this.spinner.hide();            
            this.notification("s", "Notificação", "Endereço cadastrado com sucesso!" );        
            this.closeAddress.emit(true);            
          }).
          catch(error => {
            this.error(error.error);
            this.spinner.hide();
          });
      } else {
        this.address.id = this.idAddress;
        this.addressService.putAddress(this.address).
          then(value => {
            this.spinner.hide();
            this.notification("s", "Notificação", "Endereço salvo com sucesso!" );                    
            this.closeAddress.emit(true);
          }).
          catch(error => {
            this.error(error.error);
            this.spinner.hide();
          });
      }

    } catch (e) {      
      this.error(e);
    }    
  }

  error(error){    
    this.notification("e", "Erro", error );        
  }

  onClose() {
    this.closeAddress.emit(true);
  }



}
