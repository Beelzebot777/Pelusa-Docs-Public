---
name: Implementation
about: Track the implementation details of the endpoint.
title: "Implementation for /alarms/alarms Endpoint"
labels: implementation
assignees: Gaby
---

## **Dependencies**
The implementation relies on the following third-party packages:
- **FastAPI**: Framework for building the API.
- **SQLAlchemy**: ORM for database interactions.
- **Pydantic**: Data validation and serialization.
- **Loguru**: Logging for monitoring and debugging.
- **AsyncSession**: For asynchronous database operations.

## **Code Structure**
The code is organized into modular components for maintainability and scalability:

1. **Routes**:
   - File: `app/alarms/routes.py`
   - Handles HTTP requests and delegates logic to the services layer.
   - Validates incoming requests, including authentication and client IP checks.

2. **Services**:
   - File: `app/alarms/services.py`
   - Contains the business logic for processing and validating requests.
   - Transforms raw database results into responses following the schema `AlarmResponse`.

3. **Repositories**:
   - File: `app/alarms/crud.py`
   - Interacts directly with the database to fetch alarm data using SQLAlchemy.

4. **Schemas**:
   - File: `app/alarms/schemas.py`
   - Defines the structure and validation rules for the response model `AlarmResponse`.

5. **Utilities**:
   - File: `app/utils/ip_check.py`
   - Contains helper functions for security, such as validating client IP addresses.

6. **Database Session**:
   - File: `app/siteground/database.py`
   - Provides the database connection dependency.

## **Sample Code**

### **Route**
```python
    from fastapi import APIRouter, Depends, Request, Query, HTTPException
    from sqlalchemy.ext.asyncio import AsyncSession
    from app.siteground.database import get_db_alarmas
    from app.alarms.schemas import AlarmResponse
    from typing import List
    from app.alarms.services import fetch_alarms
    from app.utils.ip_check import is_ip_allowed
    from loguru import logger

    router = APIRouter()

    @router.get("/alarms", response_model=List[AlarmResponse])
    async def get_alarms_endpoint(
        request: Request,
        db: AsyncSession = Depends(get_db_alarmas),
        limit: int = Query(default=10, ge=1),
        offset: int = Query(default=0, ge=0),
        latest: bool = Query(default=False)
    ):
        client_ip = request.client.host
        logger.info(f"Fetching alarms from {client_ip}")

        # **401 Unauthorized: Token missing or invalid**
        auth_header = request.headers.get("Authorization")
        if not auth_header or not auth_header.startswith("Bearer "):
            logger.warning(f"Unauthorized access attempt from {client_ip}")
            raise HTTPException(status_code=401, detail="Invalid or missing authentication token.")

        # **403 Forbidden: IP not allowed**
        await is_ip_allowed(client_ip)

        try:
            alarms = await fetch_alarms(limit=limit, offset=offset, latest=latest, db=db)
            return alarms
        except HTTPException as e:
            raise e
        except Exception as e:
            logger.error(f"Error fetching alarms: {e}")
            raise HTTPException(status_code=500, detail="Unexpected server error.")
```

## **Service**

```python
    #Path: app/alarms/services.py

    from sqlalchemy.orm import Session
    from fastapi import HTTPException
    from loguru import logger
    from app.alarms.repositories import get_alarms
    from app.alarms.schemas import AlarmResponse

    async def fetch_alarms(limit: int, offset: int, latest: bool, db: Session):
        """
        Fetch alarms from the database with given parameters.

        Args:
            limit (int): The maximum number of alarms to fetch.
            offset (int): The number of alarms to skip before starting to fetch.
            latest (bool): Whether to fetch the latest alarms.
            db (Session): The database session to use for fetching alarms.

        Returns:
            List[AlarmResponse]: A list of validated alarm responses.

        Raises:
            HTTPException: If there is an error fetching the alarms.
        """
        try:
            alarms = await get_alarms(db, limit=limit, offset=offset, latest=latest)
            return [AlarmResponse.model_validate(alarm) for alarm in alarms]
        except Exception as e:
            logger.error(f"Error fetching alarms: {e}")
            raise HTTPException(status_code=500, detail="There was an error fetching the alarms")
```

## **Repository**
```Python
    from sqlalchemy.ext.asyncio import AsyncSession
    from sqlalchemy.future import select
    from app.alarms.models import Alarm

    async def get_alarms(db: AsyncSession, limit: int = 10, offset: int = 0, latest: bool = False):
        """
        Fetches a list of alarms from the database.
        """
        query = select(Alarm).offset(offset).limit(limit)
        if latest:
            query = query.order_by(Alarm.id.desc())
        result = await db.execute(query)
        return result.scalars().all()
```

## **Repository**
    
```Python
    from pydantic import BaseModel
    from typing import Optional

    class AlarmResponse(BaseModel):
        id: int
        Ticker: str
        Temporalidad: str
        Quantity: Optional[str] = None
        Entry_Price_Alert: Optional[str] = None
        Exit_Price_Alert: Optional[str] = None
        Time_Alert: str
        Order: str
        Strategy: Optional[str] = None
        
        class Config:
            from_attributes = True

```

## **Asynchronous Programming**
The implementation leverages `async/await` for handling I/O-bound operations, ensuring scalability and responsiveness:

1. **Database Queries**:
   - Uses `AsyncSession` from SQLAlchemy to fetch alarm data asynchronously.

2. **Service Layer**:
   - The `fetch_alarms` service function processes the alarms asynchronously.

3. **Endpoint**:
   - Handles client requests asynchronously to prevent blocking operations.

---

## **Security Measures**

1. **Token Validation**:
   - Verifies the presence and format of the `Authorization` header.
   - Returns `401 Unauthorized` for missing or invalid tokens.

2. **IP Filtering**:
   - Checks if the client IP is allowed using `is_ip_allowed`.
   - Returns `403 Forbidden` for unauthorized IPs.

---

## **Response Codes**

- **`200 OK`**: Alarms retrieved successfully.
- **`400 Bad Request`**: Invalid query parameters.
- **`401 Unauthorized`**: Missing or invalid authentication token.
- **`403 Forbidden`**: Client's IP address is not allowed.
- **`500 Internal Server Error`**: Unexpected error while fetching alarms.