### **Logic Design for the `Alarms` Component**

---

#### **Responsibilities**
The `Alarms` component will handle the following internal logic:

1. **Filter Management**:
   - Update `appliedFilters` in `FilteredAlarmsState` based on user input from checkboxes.
   - Dynamically populate `strategies` and `tickers` filter options based on the data available in `AlarmTable`.

2. **Pagination**:
   - Handle pagination for:
     - The main `AlarmTable` (using `AlarmState.page` and `AlarmState.offset`).
     - `FilteredAlarmsState` and `SelectedAlarmState`.

3. **Selection Management**:
   - Add or remove alarms in `SelectedAlarmState.data` when users click on a marker in the chart or a row in the table.

4. **Data Synchronization**:
   - Ensure that the data displayed in the table, chart, and stats panel is always synchronized with the Redux state.

5. **Error Handling**:
   - Display error messages from `AlarmState.error` when data fails to load.

6. **Statistics Updates**:
   - Calculate and display general statistics (e.g., last captured alarm, total alarms captured today) based on the Redux state.

7. **Periodic Data Fetching**:
    - Fetch alarm data from the fetchAlarms endpoint every 1 second.
    - Update the AlarmState.data array with the latest alarm data while maintaining pagination and filtering consistency.

8. **Data Series Creation for `AlarmPanel`**:
   - Generate dynamic data series from alarms available in the Redux state.
   - Use these series to power:
     - **Chart Visualizations**: Provide structured data for bar, pie, or line charts in the `AlarmGraph` subcomponent.
     - **General Statistics**: Calculate key metrics for display in the `AlarmStats` subcomponent.
   - Ensure that the series are updated in real-time based on changes in filters or global state data.

---

#### **State and Props**

1. **State** (Local React State Variables):
   - `isDropdownOpen`: Boolean to manage the visibility of filter dropdowns.
   - `currentTabTable`: String indicating the active tab in `AlarmTablePanel` (`Alarms`, `Selected Alarms`, `Filtered Alarms`).
   - `currentTabPanel`: String indicating the active tab in `AlarmPanel` (`AlarmGraph` or `AlarmStats`).

2. **Props**:
   - **From Redux**:
     - `AlarmState`: Contains alarm data, loading status, error messages, and pagination info.
     - `FilteredAlarmsState`: Contains filtered alarm data, pagination info, and `appliedFilters`.
     - `SelectedAlarmState`: Contains selected alarm data and pagination info.
   - **Callbacks**:
     - `onAlarmSelect`: Function to handle alarm selection from the chart or table.
     - `onFilterApply`: Function to update `FilteredAlarmsState.appliedFilters` based on user input.

---

#### **Events and Handling**

1. **Filter Changes**:
   - **Event**: User interacts with a checkbox in the filter dropdown.
   - **Behavior**:
     - Update `appliedFilters` in `FilteredAlarmsState`.
     - Fetch new filtered data based on updated filters.

2. **Pagination**:
   - **Event**: User navigates to a new page in any table.
   - **Behavior**:
     - Fetch new data for the selected page from Redux state or API.
     - Update `page` in `AlarmState`, `FilteredAlarmsState`, or `SelectedAlarmState`.

3. **Alarm Selection**:
   - **Event**: User clicks on a chart marker or table row.
   - **Behavior**:
     - Add the selected alarm to `SelectedAlarmState.data`.
     - If the alarm is already selected, remove it from `SelectedAlarmState.data`.

4. **Tab Change (Table)**:
   - **Event**: User switches between tabs in `AlarmTablePanel`.
   - **Behavior**:
     - Update `currentTabTable` in local state.
     - Fetch or display data relevant to the selected tab.

5. **Tab Change (Panel)**:
   - **Event**: User switches between tabs in `AlarmPanel`.
   - **Behavior**:
     - Update `currentTabPanel` in local state.
     - Fetch or display relevant data for the selected tab (`AlarmGraph` or `AlarmStats`).

6. **Error Handling**:
   - **Event**: API call fails to fetch alarms.
   - **Behavior**:
     - Display the error message from `AlarmState.error`.
     - Provide a retry mechanism for the user.

7. **Statistics Updates**:
   - **Event**: Changes in the Redux state for `AlarmState.data`.
   - **Behavior**:
     - Recalculate and display general statistics such as:
       - Details of the last captured alarm.
       - Total alarms captured today.

8. **Data Series Creation**:
   - **Event**: Changes in `FilteredAlarmsState.data` or `AlarmState.data`.
   - **Behavior**:
     - Generate and update series for charts in `AlarmGraph`.
     - Calculate key metrics for display in `AlarmStats`.
     - Ensure the series reflect the currently applied filters.

---