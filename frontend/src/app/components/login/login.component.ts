import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { AuthenticationService } from '../../services/authentication.service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-login',
  imports: [MatFormFieldModule, MatInputModule, MatButtonModule, FormsModule, MatCardModule, RouterLink],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
  username = '';
  password = '';

  get isValid() {
    return this.username !== '' && this.password !== '';
  }

  constructor(public auth: AuthenticationService) {}

  login() {
    this.auth.login(this.username, this.password);
  }
}
