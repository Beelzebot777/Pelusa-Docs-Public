
# **Testing for Alarms**

## **Testing Frameworks**

- **Frameworks and Tools Used**:
  - `Pytest`: For writing and executing tests.
  - `FastAPI TestClient`: For testing endpoints.
  - `unittest.mock`: For mocking dependencies.
  - `SQLAlchemy`: For database interaction mocking.

---

## **Test Cases**

### **Service Layer Tests**
1. **Repository Error**  
   - Validate that `fetch_alarms` raises `HTTPException` when the repository fails.
2. **Database Session Mock**  
   - Test successful handling of database sessions in `fetch_alarms`.

### **Route Layer Tests**
1. **Successful Request**  
   - Validate that `/alarms/alarms` returns a `200 OK` status with correct headers and parameters.
2. **Unauthorized Access**  
   - Test scenarios where the `Authorization` header is missing or invalid.
3. **IP Restriction**  
   - Validate middleware behavior for allowed and disallowed IPs.
4. **Invalid Response Data**  
   - Ensure malformed data from the service layer results in a `400 Bad Request`.

### **Repository Layer Tests**
1. **Valid Alarms**  
   - Validate that `get_alarms` retrieves alarms from the database.
2. **Empty Result**  
   - Test behavior when no alarms are found in the database.
3. **SQLAlchemy Error Handling**  
   - Verify that `HTTPException` is raised for database errors.
4. **General Error Handling**  
   - Ensure unexpected errors raise appropriate exceptions.

---

## **Sample Test Code**

### **Service Layer Test: Repository Error**
```python
    @patch("app.alarms.repositories.get_alarms", new=AsyncMock(side_effect=Exception("Database error")))
    @pytest.mark.asyncio
    async def test_fetch_alarms_repository_error():
        db_mock = AsyncMock()
        with pytest.raises(HTTPException) as exc_info:
            await fetch_alarms(limit=2, offset=0, latest=True, db=db_mock)
        assert exc_info.value.status_code == 500
        assert exc_info.value.detail == "There was an error fetching the alarms"
```

### **Route Layer Test: Successful Request**
```python
    @patch("app.alarms.routes.fetch_alarms", new=AsyncMock(return_value=[]))
    @patch("app.alarms.routes.is_ip_allowed", new=AsyncMock(return_value=True))
    def test_get_alarms_endpoint_success():
        response = client.get(
            "/alarms/alarms",
            headers={"Authorization": "Bearer valid_token", "X-Forwarded-For": "127.0.0.1"},
            params={"limit": 5, "offset": 0, "latest": "true"}
        )
        assert response.status_code == 200
        assert isinstance(response.json(), list)
```    

## **Coverage**

### **Current Coverage**
- **Service Layer**: 90%  
  - Covers error handling and successful execution paths.
- **Route Layer**: 100%  
  - Validates all endpoint scenarios including success, authentication, and IP restrictions.
- **Repository Layer**: 95%  
  - Covers successful queries, empty results, and error scenarios.

