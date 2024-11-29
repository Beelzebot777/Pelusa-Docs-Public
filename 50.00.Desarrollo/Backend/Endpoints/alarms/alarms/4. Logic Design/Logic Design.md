---
name: Logic Design
about: Define the internal business logic and validation for the endpoint.
title: "Logic Design for Alarms Endpoint"
labels: logic
assignees: Gabriel Roca
---

## **Input Validation**
- **Query Parameters**:
  - `limit`:
    - Must be a positive integer.
    - Default value is `10`.
  - `offset`:
    - Must be a non-negative integer.
    - Default value is `0`.
  - `latest`:
    - Must be a boolean (`true` or `false`).
    - Default value is `false`.

## **Business Rules**
1. Only fetch alarms that match the provided parameters (`limit`, `offset`, `latest`).
2. Alarms must be sorted by `id` in descending order when `latest=true`.
3. Pagination should ensure that results are retrieved efficiently based on the `limit` and `offset`.
4. If no alarms match the query parameters, return an empty list with a `200 OK` response.

## **Error Handling**
1. **Validation Errors**:
   - If any query parameter is invalid:
     - Return a `400 Bad Request` with details about the invalid parameter.
     - Example:
       ```json
       {
         "detail": "Query parameter 'limit' must be a positive integer."
       }
       ```
2. **Database Errors**:
   - Log the error using the application logger.
   - Return a `500 Internal Server Error` with a generic message:
     ```json
     {
       "detail": "There was an error fetching the alarms."
     }
     ```

3. **IP Not Allowed**:
   - If the client's IP is not in the allowlist:
     - Return a `403 Forbidden` with the following message:
       ```json
       {
         "detail": "Access from this IP address is not allowed."
       }
       ```

## **Security Measures**
1. **Authentication**:
   - Requires a valid `Authorization` Bearer token in the request header.
   - Token is verified for authenticity and expiry.
2. **Authorization**:
   - Ensure that the client's IP is validated against the allowlist.
3. **Rate Limiting**:
   - Maximum of 60 requests per minute per IP to prevent abuse.

---
