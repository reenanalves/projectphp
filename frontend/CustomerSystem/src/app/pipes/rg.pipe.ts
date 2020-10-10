import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'rg'
})
export class RgPipe implements PipeTransform {

  transform(value: string, ...args: any[]): any {
    if (value.length === 9) {
      return value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})/g, '\$1.\$2.\$3\-\$4');
    }
    return 'error';
  }

}
