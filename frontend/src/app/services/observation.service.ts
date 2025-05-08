import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, map } from 'rxjs';
import { Observation } from '../model/observation';
import { ApiResponse } from '../model/api-response';

@Injectable({
  providedIn: 'root',
})
export class ObservationService {
  private server = 'http://localhost:8082/api/observations';
  private headers = new HttpHeaders({ 'Content-Type': 'application/ld+json' });
  private patch_headers = new HttpHeaders({
    'Content-Type': 'application/merge-patch+json',
  });

  constructor(private http: HttpClient) {}

  public all(): Observable<Observation[]> {
    return this.http
      .get<ApiResponse<Observation>>(this.server)
      .pipe(map((res) => res.member));
  }

  public get(id: number): Observable<Observation> {
    return this.http.get<Observation>(`${this.server}/${id}`, {
      headers: this.headers,
    });
  }

  public create(Observation: Observation): Observable<boolean> {
    return this.http
      .post(this.server, Observation, { headers: this.headers, observe: 'response' })
      .pipe(map((res) => res.status === 201));
  }

  public update(Observation: Observation): Observable<boolean> {
    return this.http
      .patch(`${this.server}/${Observation.id}`, Observation, {
        headers: this.patch_headers,
        observe: 'response',
      })
      .pipe(map((res) => res.status === 200));
  }

  public delete(id: number): Observable<boolean> {
    return this.http
      .delete(`${this.server}/${id}`, { observe: 'response' })
      .pipe(map((res) => res.status === 204));
  }
}