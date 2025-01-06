# Logic Design

## **Responsibilities**
- **Internal Logic**:
  - Manage navigation by updating the `selectedTab` state in the Redux store when a navigation item is clicked.
  - Handle disabled states of navigation items to prevent interaction with unimplemented components.
  - Dynamically apply styles to indicate hover, selected, and disabled states.

---

## **State and Props**

### **State**
- **Global State (Redux):**
  - `selectedTab`: Variable that tracks the currently active tab to determine which content is displayed.
    ```typescript
    // src/slices/tabSlice.js
    import { createSlice } from '@reduxjs/toolkit';

    export const tabSlice = createSlice({
      name: 'tab',
      initialState: {
        selectedTab: 0, // Initial tab by index
      },
      reducers: {
        setSelectedTab: (state, action) => {
          state.selectedTab = action.payload;
        },
      },
    });

    export const { setSelectedTab } = tabSlice.actions;
    export const selectSelectedTab = (state) => state.tab.selectedTab;
    export default tabSlice.reducer;
    ```

### **Props**
- **Props Passed to the Component:**
  - `navigationItems`: Array of objects representing navigation components, including their `id`, `name`, `icon`, and `disabled` state.
    ```typescript
    navigationItems: Array<NavigationItem>
    ```

---

## **Events and Handling**
- **Handled Events:**
  - **Tab Click Event:**
    - **Behavior:** Updates the global `selectedTab` state in Redux and navigates to the corresponding route.
    - **Example Implementation:**
      ```typescript
      import { useDispatch } from 'react-redux';
      import { setSelectedTab } from 'reduxStore/tabSlice';
      import { useNavigate } from 'react-router-dom';

      const handleTabClick = (index, route) => {
        if (!navigationItems[index].disabled) {
          dispatch(setSelectedTab(index));
          navigate(route); // Using `useNavigate` from React Router
        }
      };
      ```

  - **Hover Event:**
    - **Behavior:** Changes the visual style of the navigation item to indicate hover interaction.

  - **Disabled State Handling:**
    - **Behavior:** Prevents navigation and applies a distinct visual style (e.g., gray) to disabled items.
    - **Example:**
      ```typescript
      className={({ selected }) =>
        navigationItems[index].disabled
          ? 'cursor-not-allowed bg-gray-500'
          : `hover:bg-african_violet-300 ${selected ? 'bg-african_violet-400' : ''}`
      }
      ```

---

