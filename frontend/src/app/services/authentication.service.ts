import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';

interface Token { token: string, userid: number, roles: string[] }

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  private auth = 'http://localhost:8082/auth';
  private registration = 'http://localhost:8082/api/registration';
  private _token?: string = undefined
  private _email?: string = undefined
  private _userid?: number = undefined
  private _roles?: string[] = undefined
  private _error = false


  public reset_error() { this._error = false }

  public get error() { return this._error }

  public get isAuthentified(): boolean {
    return this._token !== undefined
  }

  public get token(): string {
    return this._token ? this._token : ''
  }

  public get email(): string {
    return this._email ? this._email : ''
  }

  public get roles(): string[] {
    return this._roles ? this._roles : []
  }

  public get userid(): number {
    return this._userid ? this._userid : NaN
  }


  constructor(private http: HttpClient, private router: Router) {}

  public login(email: string, password: string): void {
    const headers =
      new HttpHeaders({ 'Content-Type': 'application/ld+json' });
    this.http.post<Token>(this.auth,
      { email, password }, { headers })
      .subscribe({
        next: (response: Token) => {
          if (response) {
            this._token = response['token']
            this._userid = response['userid']
            this._roles = response['roles']
            this._email = email
            this.router.navigate(['/animals'])
          } else this._error = true
        },
        error: () => { this._error = true }
      })
  }

  public logout(): void {
    this._token = undefined
    this._userid = undefined
    this._email = undefined
    this._roles = undefined
    this.router.navigate(['/login'])
  }

  public register(email: string, password: string, roles: string[]): void {
    this.http.post<Token>(this.registration,
      { email, password, roles })
      .subscribe({
        next: (response: Token) => {
          if (response) {
            this._token = response['token']
            this._userid = response['userid']
            this._roles = roles
            this._email = email
            this.router.navigate(['/login'])
          } else this._error = true
        },
        error: () => { this._error = true }
      })
  }
}
