# Logic Design

## **1. Responsibilities**

### **Description**
The `Charts` component is responsible for providing an interactive and analytical interface for trading-related data visualization. The logic is centered around user interactions, data processing, and ensuring seamless integration with the backend and other application modules.

### **Key Responsibilities**

- **Behavioral Logic**:
  - Handle user interactions with the chart, such as adding markers, selecting tools, or toggling indicators.
  - Provide real-time updates to the chart based on user actions or incoming data.

- **Data Processing**:
  - Normalize and transform data fetched from the API for consistent rendering.
  - Dynamically apply filters and compute derived data for indicators like EMAs and Stochastic.

- **Error Handling**:
  - Manage errors gracefully by displaying error messages or fallback content when API calls fail.
  - Validate user input and ensure robust handling of invalid operations.

---

## **2. State and Props**

### **State Management**

#### **Local State Variables**
- `selectedTool`: Tracks the currently active tool from the sidebar. Default: `'clickTool'`.
- `isDrawing`: Boolean indicating if the user is actively drawing on the chart. Default: `false`.
- `markers`: Array of markers currently displayed on the chart. Default: `[]`.
- `isLoading`: Boolean indicating if the chart data is loading. Default: `true`.
- `hasError`: Boolean indicating if there was an error during data fetching. Default: `false`.

#### **Derived State**
- `activeIndicators`: Computed from the tools or user-selected options to determine which indicators are visible.
- `filteredData`: Derived by applying user-defined filters to the original dataset.

### **Props Specification**

#### **Expected Props**
- **`data`**: The complete trading data passed from the parent component.
  ```typescript
  data: {
    alarms: Array<Alarm>,
    orders: Array<Order>,
    positions: Array<Position>,
    diary: Array<DiaryEntry>,
    news: Array<News>,
    earnings: Array<Earning>
  };
  ```
- **`onMarkerAdd`**: Callback triggered when a new marker is added.
  ```typescript
  onMarkerAdd: (marker: Marker) => void;
  ```
- **`onToolChange`**: Callback triggered when the user selects a new tool from the sidebar.
  ```typescript
  onToolChange: (toolId: string) => void;
  ```

#### **Validation and Defaults**
- `data` is required and defaults to an empty object structure.
- `onMarkerAdd` and `onToolChange` are required callbacks for seamless integration.

---

## **3. Events and Handlers**

### **Event Handling**

#### **User Events**
1. **Tool Selection**:
   - Triggered when the user clicks a tool in the sidebar.
   - Updates the `selectedTool` state and triggers the `onToolChange` callback.
   ```javascript
   const handleToolSelection = (toolId) => {
     setSelectedTool(toolId);
     onToolChange(toolId);
   };
   ```

2. **Marker Placement**:
   - Adds a new marker to the chart when the user interacts with the drawing tool.
   - Updates the `markers` state and calls the `onMarkerAdd` callback.
   ```javascript
   const handleMarkerPlacement = (markerData) => {
     const newMarker = {
       ...markerData,
       id: Date.now(),
     };
     setMarkers((prevMarkers) => [...prevMarkers, newMarker]);
     onMarkerAdd(newMarker);
   };
   ```

3. **Indicator Toggle**:
   - Toggles the visibility of an indicator (e.g., EMA, Stochastic).
   - Updates the `activeIndicators` derived state.
   ```javascript
   const toggleIndicator = (indicator) => {
     setActiveIndicators((prev) => {
       return prev.includes(indicator)
         ? prev.filter((i) => i !== indicator)
         : [...prev, indicator];
     });
   };
   ```

#### **System Events**
1. **Data Fetching**:
   - Automatically fetch data when the component mounts.
   - Handles loading and error states.
   ```javascript
   useEffect(() => {
     setIsLoading(true);
     fetchChartData()
       .then((data) => {
         setChartData(data);
         setIsLoading(false);
       })
       .catch(() => {
         setHasError(true);
         setIsLoading(false);
       });
   }, []);
   ```

2. **Error Handling**:
   - Displays an error message if data fetching fails.
   ```javascript
   if (hasError) {
     return <div>Error loading chart data.</div>;
   }
   ```

---

## **4. Conditional Logic**

### **Description**
The component uses conditional logic to adjust its behavior dynamically based on state and user actions.

#### **Examples**
- **Loading State**:
  - Show a spinner when `isLoading` is true.
  ```javascript
  {isLoading && <Spinner />}
  ```

- **Error State**:
  - Show an error message when `hasError` is true.
  ```javascript
  {hasError && <ErrorMessage message="Failed to load data" />}
  ```

- **Active Tool Behavior**:
  - Adjust chart interactions based on the selected tool.
  ```javascript
  if (selectedTool === "drawLine") {
    enableLineDrawingMode();
  }
  ```

---

## **5. Optimization Strategies**

### **Performance Optimizations**
1. **Memoization**:
   - Use `React.memo` for tools and markers to avoid unnecessary re-renders.
   - Cache filtered data using `useMemo`.
   ```javascript
   const filteredData = useMemo(() => {
     return data.alarms.filter((alarm) => alarm.type === selectedType);
   }, [data.alarms, selectedType]);
   ```

2. **Debouncing**:
   - Debounce user inputs (e.g., when drawing or filtering).
   ```javascript
   const debouncedHandleInput = debounce(handleInput, 300);
   ```

3. **Lazy Loading**:
   - Load additional data for the chart only when needed.

### **Code Reusability**
- **Custom Hooks**:
  - Extract reusable logic into hooks such as `useChartData` or `useToolState`.
  ```javascript
  const useToolState = (initialTool) => {
    const [selectedTool, setSelectedTool] = useState(initialTool);

    const changeTool = (toolId) => {
      setSelectedTool(toolId);
    };

    return { selectedTool, changeTool };
  };
  ```

- **Utility Functions**:
  - Create utility functions for repetitive tasks, such as marker normalization.
  ```javascript
  const normalizeMarkerData = (rawData) => {
    return rawData.map((marker) => ({
      ...marker,
      time: Math.floor(new Date(marker.time).getTime() / 1000),
    }));
  };
  ```

---

This logic design ensures that the `Charts` component is robust, efficient, and user-friendly, with clearly defined responsibilities and optimized performance for seamless integration.

