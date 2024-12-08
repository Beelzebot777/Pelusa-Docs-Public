# **Wireframe Design for `Alarms` Component**

## **Purpose**
The `Alarms` component aims to provide a comprehensive interface for viewing and analyzing alarm data, ensuring an interactive and accessible user experience. The wireframe design lays out the structure, hierarchy, and essential elements of the component to guide the implementation of the UI.

---

## **Structure**

### 1. **Main Chart Area (`AlarmOverlay`)**
- Displays alarms as visual markers directly on the candlestick chart.
- Positioned at the top, occupying ~70% of the width.
- Markers are interactive (hoverable, clickable) to view alarm details.

### 2. **`AlarmPanel`**
- Positioned to the right of the Main Chart Area.
- Occupies ~30% of the width.
- Contains two tabs:
  - **Tab 1**: `AlarmGraph` (Interactive visual analysis of alarm data).
  - **Tab 2**: `AlarmStats` (General statistics about alarms).

### 3. **`AlarmTablePanel`**
- Positioned below the Main Chart Area and `AlarmPanel`.
- Contains three tabs:
  - **Tab 1**: `Alarms` - Displays all alarms without filters.
  - **Tab 2**: `Selected Alarms` - Displays alarms selected via clicks on the chart or tables.
  - **Tab 3**: `Filtered Alarms` - Displays alarms filtered based on applied filters.
- Includes `AlarmTableFilters`:
  - Dropdown menus for filtering by:
    - **Intervals** (`1m`, `5m`, `15m`, `30m`, `1h`, `4h`, `D`, `W`, `M`).
    - **Order Type** (Open Long, Close Long, Open Short, Close Short).
    - **Strategies** (Dynamic list from the database).
    - **Tickers** (Dynamic list from the database).
  - Supports multiple selection, "select all," and "clear all" functionality.

### 4. **`AlarmTable`**
- Displays alarms in a tabular format within the `AlarmTablePanel`.
- Columns:
  - **ID**, **Ticker**, **Interval**, **Price**, **Time**, **Type**, **Strategy**.
- Features sorting, pagination, and integration with filters.

---

## **Wireframe**

### **Layout Overview**
1. **Top Section**:  
   - **Main Chart Area**:
     - Candlestick chart.
     - `AlarmOverlay` markers for visualizing alarms.

2. **Right Section**:  
   - **AlarmInfoPanelContainer**:
     - Minimun Two tabs (`AlarmGraph` and `AlarmStats`).
     - Each tab displays its corresponding content (charts or statistics).

3. **Bottom Section**:  
   - **AlarmTableContaioner**:
     - Three tabs (`Alarms`, `Selected Alarms`, `Filtered Alarms`).
     - Filters for intervals, order types, strategies, and tickers.
     - Dynamic table (`AlarmTable`) showing alarm data.

---

## **Content**

### **Main Chart Area**
- Interactive markers for alarms.
- Tooltip to display details on hover.

### **AlarmInfoPanel**
- **AlarmGraph**:
  - Charts for intervals, strategies, tickers, type orders, and monthly distributions.
- **AlarmStats**:
  - Last captured alarm (time, date, strategy).
  - Total alarms captured today.

### **AlarmTablePanelContainer**
- **Filters**:
  - Dropdowns with multi-select functionality.
  - Real-time filtering updates.
- **Tabs**:
  - `Alarms`: Unfiltered alarm list.
  - `Selected Alarms`: Alarms selected via interactions.
  - `Filtered Alarms`: Dynamically updated based on applied filters.
- **Table**:
  - Columns: ID, Ticker, Interval, Price, Time, Type, Strategy.
  - Pagination and sorting support.

---

## **Behavior Flow**

### **1. Tab Navigation**
- Users switch between tabs to view specific content (`AlarmGraph`, `AlarmStats`, or filtered tables).

### **2. Filter Interaction**
- Dropdowns update the table and charts dynamically.

### **3. Chart Interaction**
- Clicking on a marker adds it to the `Selected Alarms` tab.

### **4. Table Interaction**
- Clicking on a row highlights the corresponding marker on the chart if the `Filtered By Click` tab is active.

---
