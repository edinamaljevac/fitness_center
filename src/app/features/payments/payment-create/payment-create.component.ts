import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { Router, RouterLink } from '@angular/router';
import { PaymentService } from '../../../core/services/payment.service';

@Component({
  selector: 'app-payment-create',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, RouterLink],
  templateUrl: './payment-create.component.html',
  styleUrl: './payment-create.component.css',
})
export class PaymentCreateComponent implements OnInit {
  paymentForm!: FormGroup;
  memberships: any[] = [];
  loading = true;
  saving = false;
  errorMessage = '';

  constructor(
    private fb: FormBuilder,
    private paymentService: PaymentService,
    private router: Router,
  ) {
    this.paymentForm = this.fb.group({
      membership_id: ['', [Validators.required]],
      iznos: ['', [Validators.required, Validators.min(0.01)]],
      nacin_placanja: ['gotovina', [Validators.required]],
      broj_racuna: [''],
      napomena: [''],
    });
  }

  ngOnInit(): void {
    this.loadMemberships();
  }

  loadMemberships(): void {
    this.paymentService.getActiveMemberships().subscribe({
      next: (response) => {
        this.memberships = response.data;
        this.loading = false;
      },
      error: () => {
        this.errorMessage = 'Greška pri učitavanju aktivnih članstava.';
        this.loading = false;
      },
    });
  }

  submit(): void {
    if (this.paymentForm.invalid) {
      this.paymentForm.markAllAsTouched();
      return;
    }

    this.saving = true;
    this.errorMessage = '';

    this.paymentService.createPayment(this.paymentForm.value).subscribe({
      next: () => {
        this.router.navigate(['/payments']);
      },
      error: (error) => {
        this.errorMessage =
          error.error?.message || 'Greška pri evidentiranju uplate.';
        this.saving = false;
      },
    });
  }
}
