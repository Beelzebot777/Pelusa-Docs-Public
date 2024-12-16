# **AlarmsMainView Usage Document**

## **Implementation Examples**

Here is an example of how to use the `AlarmsMainView` component in an application.

```javascript
import AlarmsMainView from 'path/to/AlarmsMainView';

const App = () => {
  return (
    <div>
      <AlarmsMainView />
    </div>
  );
};

export default App;
```

# **Component API**

| **Prop Name**             | **Type**   | **Description**                                   | **Default** |
|--------------------------|------------|-------------------------------------------------|-------------|
| `showButtonsPanel`        | `boolean`  | Controls the visibility of buttons in MainChart. | `true`      |
| `updateShowButtonsPanel`  | `function` | Callback to toggle visibility of button panels. | `null`      |
| `alarmsData`              | `array`    | The main array containing all alarm data.        | `[]`        |
| `filteredByClickAlarmsData` | `array`  | Alarms filtered by user clicks.                  | `[]`        |
| `filteredByOptionsAlarmsData` | `array`| Alarms filtered using filter options.           | `[]`        |

---

## **Subcomponents**

### **MainChart**
- **Description**: Displays the main candlestick chart with alarm markers.
- **Props**:
  - `showButtonsPanel`: Boolean that controls visibility of button panel.
  - `updateShowButtonsPanel`: Callback function to toggle visibility of the buttons.

### **AlarmTablesContainer**
- **Description**: Contains tabular data for alarms in different views.
- **Tabs**:
  - **All Alarms**: Displays all alarms from the system.
  - **Selected Alarms**: Displays alarms that have been selected via chart interaction.
  - **Filtered Alarms**: Displays alarms that match specific filter criteria.

### **AlarmInfoPanel**
- **Description**: Shows relevant information about alarms, such as charts and statistics.
- **Props**:
  - `alarmsData`: Data used to populate charts and statistics.
  - `filteredByClickAlarmsData`: Data filtered based on clicks from the user.
  - `filteredByOptionsAlarmsData`: Data filtered based on options chosen by the user.

---

## **Notes and Warnings**

1. **Data Integrity**: Ensure that `alarmsData`, `filteredByClickAlarmsData`, and `filteredByOptionsAlarmsData` are non-null to avoid runtime errors. Use empty arrays `[]` as defaults.
2. **Performance**: Since `AlarmsMainView` includes Redux selectors, ensure efficient memoization to prevent unnecessary re-renders.
3. **Error Handling**: If the API call fails to fetch alarm data, ensure that error states are handled gracefully in subcomponents like `AlarmTablesContainer`.

---

## **Usage Context**

The `AlarmsMainView` component serves as the primary entry point for the **Alarms** system, combining three key sections:

1. **Main Chart Section**
   - Displays a visual representation of alarms directly on a candlestick chart.
   
2. **Information Panel**
   - Contains additional information, such as general statistics, and allows users to view Alarm Graphs and Alarm Stats.
   
3. **Tables Section**
   - Displays alarms in tabular form with options to filter, view, and interact with the data.

---

## **Design and Layout**

- **Flexbox Design**: The component layout uses Tailwind's grid system (`grid grid-cols-10`) to achieve a layout where the Main Chart occupies 70% of the width and the Info Panel occupies 30%.
- **Subcomponent Layout**:
  - **Main Chart**: Occupies `col-span-7` of the grid.
  - **Info Panel**: Occupies `col-span-3` of the grid.
  - **Alarm Table Section**: Placed at the bottom, spanning the full width, and encapsulated in a card-like layout (`bg-african_violet-300 rounded-sm`).

---

## **Key Functionalities**

1. **Real-time Data Updates**: The `AlarmsMainView` uses Redux selectors to listen for changes in the alarm data and automatically updates the display accordingly.
2. **Filtering and Click Interaction**: Users can filter alarms using checkboxes, and click on alarm markers or rows to highlight the corresponding alarms.
3. **Dynamic Visualization**: Uses charts (like bar or radar charts) to visualize alarm statistics in the `AlarmInfoPanel`.

---

## **Redux Integration**

### **Selectors Used**
- `selectAlarmsData`: Selects the main array of alarm data.
- `selectFilteredByClickAlarms`: Selects alarms filtered via user clicks.
- `selectFilteredByOptionsAlarms`: Selects alarms filtered by option filters.

### **Redux State Requirements**
- Ensure that `alarmsData`, `filteredByClickAlarmsData`, and `filteredByOptionsAlarmsData` are available in the Redux store.

---

## **Testing Notes**

1. **Component Rendering**: Verify that `AlarmsMainView` renders with the correct layout.
2. **Data Propagation**: Ensure that all subcomponents receive the expected props and display data correctly.
3. **Interactive Elements**: Test the click interactions in the chart and table to ensure that selections work as intended.
4. **Error Handling**: Simulate an error state where no data is returned and ensure the error message is displayed.

---

## **Planned Improvements**

1. **Lazy Loading of Components**: Improve performance by dynamically loading the `AlarmInfoPanel` and `AlarmTablesContainer` when they are first used.
2. **Memoization and Re-renders**: Use `React.memo` to prevent unnecessary re-renders of subcomponents like `AlarmInfoPanel` and `MainChart`.
3. **Accessibility Improvements**: Ensure all buttons and interactive elements are accessible via keyboard and screen readers.

---

## **Change Log**

| **Date**       | **Change**                          | **Reason**                    | **Impact**                   |
|----------------|-------------------------------------|---------------------------------|---------------------------------|
| **2024-12-10** | Initial component implementation     | Main layout and basic logic     | Core structure completed       |
| **2024-12-11** | Added real-time data updates        | Live data support              | Improved UX with real-time data |
| **2024-12-15** | Added filtering functionality       | Filter by intervals and types  | Enhanced data navigation       |

---

This **AlarmsMainView Usage Document** provides a comprehensive overview of the component's API, layout, functionality, and notes for developers. The document ensures clear guidance for integration, usage, and maintenance.
