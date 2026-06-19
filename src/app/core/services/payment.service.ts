import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class PaymentService {
  private apiUrl = '/api';

  constructor(private http: HttpClient) {}

  getPayments(search: string = '') {
    return this.http.get<any>(`${this.apiUrl}/payments`, {
      params: {
        search: search,
      },
    });
  }

  getPayment(id: number | string) {
    return this.http.get<any>(`${this.apiUrl}/payments/${id}`);
  }

  getActiveMemberships() {
    return this.http.get<any>(`${this.apiUrl}/payments/memberships/active`);
  }

  createPayment(data: any) {
    return this.http.post<any>(`${this.apiUrl}/payments`, data);
  }
}
