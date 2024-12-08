# **Data Design for `Alarms` Component**

---

## **Input Data**

### 1. **Alarm Data**  
- **Type**: `Array<Alarm>`  
- **Format**:
  - `id`: Unique identifier for the alarm (string).
  - `ticker`: Ticker associated with the alarm (string).
  - `interval`: Time interval of the alarm (string, e.g., '1m', '5m', etc.).
  - `price`: Price at which the alarm was triggered (number).
  - `time`: Time and date in ISO8601 format (string, e.g., "2024-11-28T10:00:00Z").
  - `type`: Order type associated with the alarm (string, e.g., 'Open Long', 'Close Short').
  - `strategy`: Name of the strategy triggering the alarm (string).

---

## **Output Data**

### 1. **Applied Filters (`appliedFilters`)**

- **Part of**: `FilteredAlarmsState`.  
- **Type**: `Object`.  
- **Format**:  

  - **`intervals`**:  
    Object with boolean values representing whether each interval is selected or not.  
    - **Keys**: `"1m"`, `"5m"`, `"15m"`, `"30m"`, `"1h"`, `"4h"`, `"D"`, `"W"`, `"M"`.  
    - **Values**: `true` if the interval is selected, `false` otherwise.  
    - **Example**:  
      ```typescript
      intervals: {
        "1m": true,
        "5m": false,
        "15m": true,
        "30m": false,
        "1h": true,
        "4h": false,
        "D": true,
        "W": false,
        "M": true
      }
      ```

  - **`orderTypes`**:  
    Object with boolean values representing whether each order type is selected or not.  
    - **Keys**: `"Open Long"`, `"Close Long"`, `"Open Short"`, `"Close Short"`.  
    - **Values**: `true` if the order type is selected, `false` otherwise.  
    - **Example**:  
      ```typescript
      orderTypes: {
        "Open Long": true,
        "Close Long": false,
        "Open Short": true,
        "Close Short": false
      }
      ```

  - **`strategies`**:  
    Object with boolean values dynamically populated based on available strategies in the alarms data.  
    - **Keys**: Names of strategies (e.g., `"StrategyA"`, `"StrategyB"`).  
    - **Values**: `true` if the strategy is selected, `false` otherwise.  
    - **Example**:  
      ```typescript
      strategies: {
        "StrategyA": true,
        "StrategyB": false,
        "StrategyC": true
      }
      ```

  - **`tickers`**:  
    Object with boolean values dynamically populated based on available tickers in the alarms data.  
    - **Keys**: Names of tickers (e.g., `"BTCUSDT"`, `"ETHUSDT"`).  
    - **Values**: `true` if the ticker is selected, `false` otherwise.  
    - **Example**:  
      ```typescript
      tickers: {
        "BTCUSDT": true,
        "ETHUSDT": false,
        "BNBUSDT": true
      }
      ```

### 2. **Selected Alarms (`SelectedAlarmState`)**
- **Managed by Redux.**
- **Type**: `Object`.
- **Format**:
  - `data`: Array of selected alarms.
  - `page`: Current page for pagination of selected alarms.

### 3. **Filtered Alarms (`FilteredAlarmsState`)**
- **Managed by Redux.**
- **Type**: `Object`.
- **Format**:
  - `data`: Array of alarms matching the applied filters.
  - `page`: Current page for pagination.
  - `appliedFilters`: Contains the currently applied filters.

---

## **Global State Management with Redux**

### 1. **Alarm State (`AlarmState`)**
- **Structure**:
  - `data`: Array of all available alarms.
  - `loading`: Boolean indicating if the data is being loaded.
  - `error`: String containing the error message if the API call fails.
  - `page`: Current page for the main table.
  - `offset`: Total number of rows fetched.
  - `hasMore`: Boolean indicating if there are more rows to fetch.

### 2. **Selected Alarm State (`SelectedAlarmState`)**
- **Structure**:
  - `data`: Array of manually selected alarms.
  - `page`: Current page for pagination of selected alarms.

### 3. **Filtered Alarm State (`FilteredAlarmsState`)**
- **Structure**:
  - `data`: Array of alarms matching the applied filters.
  - `page`: Current page for pagination.
  - `appliedFilters`: Contains the currently applied filters:

---

## **API Integration**

### **Endpoint**
1. **Fetch Alarms**:
   - **Method**: `GET`
   - **Endpoint**: `/alarms/alarms`
   - **Query Parameters**:
     - `limit`: Maximum number of rows to fetch per request.
     - `offset`: Number of rows already fetched, used for pagination.
     - `latest=true`: Fetch the most recent alarms.
   - **Example Request**:
     ```http
     GET /alarms/alarms?limit=20&offset=40&latest=true
     ```
   - **Implementation**:
     ```javascript
     import { createAsyncThunk } from '@reduxjs/toolkit';
     import axios from 'axios';
     import config from '../../config';

     export const fetchAlarms = createAsyncThunk(
         'alarms/fetchAlarms',
         async ({ limit, offset }) => {
           const response = await axios.get(`${config.apiURL}/alarms/alarms?limit=${limit}&offset=${offset}&latest=true`);    
           return response.data.sort((a, b) => b.id - a.id);  
         }
     );
     ```
   - **Output**:
     - Returns an array of alarms sorted in descending order by `id`.

---

This data design ensures efficient handling of input, output, and global state, with seamless API integration for fetching alarm data.
