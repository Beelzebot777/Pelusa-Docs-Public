

## **Database Models**
```python
from sqlalchemy import Column, Integer, String
from app.siteground.base import BaseAlarmas

class Alarm(BaseAlarmas):
    __tablename__ = 'tbl_alarms'
    
    id = Column(Integer, primary_key=True, index=True)
    Ticker = Column(String(50), index=True)
    Temporalidad = Column(String(50))
    Quantity = Column(String(50))
    Entry_Price_Alert = Column(String(50))
    Exit_Price_Alert = Column(String(50))
    Time_Alert = Column(String(50))  # Formatted as string for ISO8601
    Order = Column(String(50))
    Strategy = Column(String(50))
    raw_data = Column(String(500))
```

## **Database Schema**
- **Table Name**: tbl_alarms
- **Columns**:
- - `id`: Primary key, unique identifier for each alarm.
- - `Ticker`: Indexed, represents the asset ticker (e.g., BTCUSDT).
- - `Temporalidad`: Represents the time interval of the alarm (e.g., 1m, 5m).
- - `Quantity`: Optional, indicates the quantity associated with the alarm.
- - `Entry_Price_Alert`: Optional, price for entering a trade.
- - `Exit_Price_Alert`: Optional, price for exiting a trade.
- - `Time_Alert`: Formatted as string to match ISO8601 standards.
- - `Order`: Describes the type of order (e.g., Open Long, Close Short).
- - `Strategy`: Optional, represents the strategy name.
- - `raw_data`: Stores additional unprocessed alarm data, up to 500 characters.

### **Constraints**

#### **Indexes**
- `Ticker` is indexed to optimize queries by ticker.
- `id` is automatically indexed as a primary key.

#### **Relationships**
- None for this table (standalone).

---

### **External Services**
- No external services are directly involved with this endpoint.
- Data originates from internal sources stored in the `tbl_alarms` table in the SiteGround database.

---

### **Data Flow Diagram** (Optional)

#### **Data Ingestion**
- Alarm data is inserted into the `tbl_alarms` table from the trading system or external alerts.

#### **Data Retrieval**
- The `/alarms` endpoint queries the database, filters and paginates data as per the request parameters, and returns the results to the frontend.
