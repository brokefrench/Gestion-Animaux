import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import {MatCheckboxModule} from '@angular/material/checkbox';
import { AuthenticationService } from '../../services/authentication.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-registration',
  imports: [ MatFormFieldModule, MatInputModule, MatButtonModule, FormsModule, MatCardModule, MatCheckboxModule, RouterLink],
  templateUrl: './registration.component.html',
  styleUrl: './registration.component.scss'
})
export class RegistrationComponent {
  username = ''
  password = ''
  isAdmin = false;
  get isValid() { return this.username !== '' && this.password !== '' }

  constructor(public auth: AuthenticationService) { }

  register() {
    let roles = ['ROLE_USER']

    if (this.isAdmin) {
      roles =['ROLE_USER', 'ROLE_ADMIN']
    }
    this.auth.register(this.username, this.password, roles)
  }

}
