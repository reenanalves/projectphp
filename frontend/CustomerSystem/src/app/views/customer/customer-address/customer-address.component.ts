import { Component, Input, OnInit, Output } from '@angular/core';
import { EventEmitter } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
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


  constructor(private formBuilder: FormBuilder, private addressService: AddressService) {
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
      this.addressService.getAddress(this.idAddress).
        then(value => {
          this.address = value;
        }).
        catch(error => {
          alert("Não foi possível carregar o endereço. " + error.error);
        });
    }
  }

  onSaveAddress() {

    try {

      if(!this.form.valid){
        return;
      }

      if (!this.idAddress) {
        this.address.customer_id = this.idCustomer;
        this.address.status = 1;
        this.addressService.postAddress(this.address).
          then(value => {
            alert("Endereço cadastrado com sucesso!");            
            this.closeAddress.emit(true);
          }).
          catch(error => {
            this.error(error.error);
          });
      } else {
        this.address.id = this.idAddress;
        this.addressService.putAddress(this.address).
          then(value => {
            alert("Endereço salvo com sucesso!");
            this.closeAddress.emit(true);
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

  onClose() {
    this.closeAddress.emit(true);
  }



}
