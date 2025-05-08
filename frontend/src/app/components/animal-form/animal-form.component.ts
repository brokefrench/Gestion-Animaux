import { CommonModule } from '@angular/common';
import { Component, inject } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { AnimalService } from '../../services/animal.service';
import { MatOptionModule } from '@angular/material/core';
import { MatSelectModule } from '@angular/material/select';
import { MatIcon } from '@angular/material/icon';
import { AuthenticationService } from '../../services/authentication.service';

@Component({
  selector: 'app-animal-form',
  standalone: true,
  imports: [
    CommonModule,
    ReactiveFormsModule,
    RouterModule,
    MatFormFieldModule,
    MatInputModule,
    MatButtonModule,
    MatCardModule,
    MatOptionModule,
    MatSelectModule,
    MatIcon
  ],
  templateUrl: './animal-form.component.html',
})
export class AnimalFormComponent {
  private fb = inject(FormBuilder);
  private route = inject(ActivatedRoute);
  private animalService = inject(AnimalService);
  private router = inject(Router);

  id = Number(this.route.snapshot.paramMap.get('id'));
  isEditing = this.id > 0;

  form: FormGroup = this.fb.group({
    nomCommun: ['', Validators.required],
    nomSavant: ['', Validators.required],
    embranchement: [''],
    classe: [''],
    ordre: [''],
    sousOrdre: [''],
    famille: [''],
    genre: [''],
    statusConservation: [''],
    description: [''],
  });

  constructor(public auth: AuthenticationService) {
    if(!auth.roles.includes('ROLE_ADMIN')){
      this.router.navigate(['/animals']);
    }
    if (this.isEditing) {
      this.animalService
        .get(this.id)
        .subscribe((animal) => this.form.patchValue(animal));
    }
  }

  onSubmit(): void {
    const data = this.form.value;

    if (this.isEditing) {
      data.id = this.id;
      this.animalService
        .update(data)
        .subscribe(() => this.router.navigate(['/animals']));
    } else {
      this.animalService
        .create(data)
        .subscribe(() => this.router.navigate(['/animals']));
    }
  }
}