# Implementation Document for Alarms Component

## **Code Structure**
The **Alarms** functionality is designed to ensure maintainability, modularity, and clarity. The main logic is divided into **container components** and **presentational components**, following best practices for React development.

### **1. Main Structure**
The main component of **Alarms** manages state logic, pagination, table display, and alarm-related charts. It is divided into several key parts:

- **Container Components**:
  - **AlarmsMainView**: Main component that organizes the view of alarms, including the alarm table, charts, and filter panel.
  - **AlarmTablesContainer**: Contains the alarm tables, organized into tabs (All, Filtered by Click, and Filtered by Options).
  - **AlarmFiltersPanelContainer**: Filter panel to filter alarms by intervals, tickers, strategies, and order types.
  - **AlarmInfoPanelContainer**: Information panel displaying bar charts, radar charts, and general statistics.

- **Presentational Components**:
  - **AlarmTable**: Displays a table of alarms with pagination.
  - **FiltersMenu**: Dropdown filter menu to select filter options.
  - **AlarmRow**: Represents a single row in the alarm table.
  - **Pagination**: Reusable pagination component.
  - **AlarmOverviewPanel**: Displays general statistics for the alarms.
  - **AlarmsBarChart**: Bar chart showing alarms by month.
  - **AlarmsRadarChart**: Radar chart showing active alarms by hour.

---

### **2. Related Files**
These are the key files and their roles within the overall structure.

- **UI (Visual Components)**:
  - `AlarmsMainView.jsx`
  - `AlarmTablesContainer.jsx`
  - `AlarmFiltersPanelContainer.jsx`
  - `AlarmInfoPanelContainer.jsx`
  - **Presentational components**: 
    - `FiltersMenu.jsx`
    - `AlarmTable.js`
    - `AlarmRow.js`
    - `Pagination.js`
    - `AlarmOverviewPanel.jsx`
    - `AlarmsBarChart.jsx`
    - `AlarmsRadarChart.jsx`
    - **Utility Subcomponents**: 
      - `MonthTogglePanel.jsx`
      - `FilterSection.jsx`

- **Logic (Business logic and helper functions)**:
  - **Redux Slice**:
    - `alarmSlice.js`
    - `alarmThunks.js`
    - `alarmSelectors.js`
  - **Hooks**:
    - `useFetchAlarms.jsx`
    - `useGenerateChartData.jsx`
    - `useUpdateVisibleMonths.jsx`
    - `useShowButtonsPanel.jsx`
  - **Utils**:
    - `getHourlyAlarmCounts.jsx`
    - `initChart.jsx`
    - `configChart.jsx`

---

## **Dependencies and Libraries**
The following libraries and tools were used for the **Alarms** functionality implementation.

### **1. Styling and Design**
- **Tailwind CSS**: For clean, responsive, and customizable design.
- **Headless UI**: Used to manage tab logic (`TabGroup`, `TabList`, `TabPanels`).

### **2. State Management**
- **Redux**: Handles global state for alarms, filtered alarms, and selected alarms.
- **Redux Toolkit**: Used to create slices, reducers, and thunks efficiently.

### **3. API Requests**
- **Axios**: Performs API requests for alarms with support for authorization headers and error handling.

### **4. Performance Optimization**
- **Debounce**: Used to reduce API calls when filters are applied repeatedly.
- **Memoization**: Prevents unnecessary re-renders in components like **AlarmTable** and **AlarmsBarChart**.

---

## **Implementation Details**
Below are the key considerations for the implementation of the **Alarms** functionality.

### **1. Performance Optimization**
- **Debounce** is used in the **AlarmFiltersPanelContainer** to reduce API requests when the user applies filters.
- Alarm data is stored in **Redux**, preventing redundant requests and allowing for data reuse.
- The `getHourlyAlarmCounts` function efficiently generates data for radar and bar charts.

### **2. State Management**
- **Local State**: Used in components to control the opening and closing of menus, like `FiltersMenu`.
- **Redux State**: Global state is managed using Redux Toolkit. Key slices include:
  - **alarmSlice.js**: Manages general alarms, filtered alarms, and selected alarms.
  - **interactionSlice.js**: Manages the active tab and the active dataset in the radar chart.

### **3. Testing**
- Unit tests with **Jest** and **Testing Library**:
  - Hooks and the rendering of key components are tested.
  - `data-testid` attributes are used to identify elements in tests.
  - Test files are located in `src/components/Alarms/__tests__`.

### **4. Backend Integration**
- **API Endpoint**: API is called via `alarmThunks.js` to retrieve alarms.
- **Authentication**: A token is stored in `localStorage` and used to authenticate requests.
- **API URL**: GET /alarms/alarms?limit={limit}&offset={offset}&latest=true

### **5. Styling and Theming**
- Custom Tailwind CSS classes are used for colors, typography, and backgrounds (`bg-african_violet-200`, `bg-african_violet-100`).

## **Examples of Key Functions**
### **1. Filtering Logic**
The **AlarmFiltersPanelContainer** component filters alarms based on the checkbox state.

```javascript
const handleApplyFilters = (filters) => {    
const newFilteredAlarms = alarms.filter((alarm) => {
  let results = [];
  const intervals = Object.keys(filters.intervals).filter(key => filters.intervals[key]);
  const ordersType = Object.keys(filters.ordersType).filter(key => filters.ordersType[key]);
  if (intervals.length > 0) results.push(intervals.includes(alarm.Interval));
  if (ordersType.length > 0) results.push(ordersType.includes(alarm.Order));
  return results.every(Boolean);
});
dispatch(setFilteredByOptions(newFilteredAlarms));
};
```

## **Main Components**

| **Component**           | **Responsibility**                                                                             |
|------------------------|-------------------------------------------------------------------------------------------------|
| **AlarmsMainView**       | Main view component that renders the chart, tables, and filters.                                |
| **AlarmTablesContainer**| Displays alarm tables with tabs (All, Selected, Filtered).                                      |
| **AlarmFiltersPanelContainer** | Contains the filter menu and handles filter logic.                                       |
| **AlarmInfoPanelContainer** | Displays alarm information with radar charts and general statistics.                         |
| **AlarmTable**           | Displays the alarm table with pagination.                                                      |
| **FiltersMenu**          | Filter menu with checkboxes for each interval, order type, strategy, and ticker.                |

---

