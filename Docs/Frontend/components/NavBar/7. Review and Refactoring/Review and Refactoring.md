# **NavBar Review and Refactoring**

## **Change History**

### **Code Modularization**

- **What Changed**:
  - Modularized the `TabGroup` logic into a separate `NavBar` file containing:
    ```javascript
    import { Tab, TabGroup, TabList } from '@headlessui/react';
    import { getTabClassName } from '../utils/helpers';

    const NavBar = ({selectedTab, handleTabChange, tabs}) => {
        return(
            <TabGroup vertical selectedIndex={selectedTab} onChange={handleTabChange}>
                <div className="flex">
                    <TabList className="w-12 h-screen mt-1">
                        {tabs.map((tab, index) => (
                            <Tab
                                key={index}
                                className={({ selected }) =>
                                    `w-full h-16 p-2 text-sm font-medium transition-colors duration-200 ${getTabClassName({ selected, disabled: tab.disabled })}`
                                }
                                disabled={tab.disabled}
                            >
                                <img
                                    src={tab.icon}
                                    alt={tab.name}
                                    className={`h-8 w-8 mx-auto ${tab.disabled ? 'opacity-50' : ''}`}
                                />
                            </Tab>
                        ))}
                    </TabList>
                </div>
            </TabGroup>
        );
    }
    export default NavBar;
    ```
  - Created a utility function `getTabClassName` in `helpers.jsx`:
    ```javascript
    export const getTabClassName = ({ selected, disabled }) => {
        if (disabled) {
            return 'cursor-not-allowed bg-gray-500 text-gray-500';
        }
        return `hover:bg-african_violet-300 ${
            selected
                ? 'bg-african_violet-400 text-african_violet-900'
                : 'bg-african_violet-200 text-african_violet-700 hover:text-african_violet-900'
        }`;
    };
    ```
- **Why**:
  - Enhance reusability and reduce inline logic.
- **Impact**:
  - Simplified the NavBar structure and improved code clarity.

---

## **Future Improvements**

### **Enhanced Accessibility**

- **Why**:
  - Ensure compliance with WCAG standards.
- **Benefit**:
  - Broaden usability to include keyboard navigation and screen readers.

### **Dynamic Menu Configuration**

- **Why**:
  - Load user-specific menus dynamically based on role.
- **Benefit**:
  - Reduce unused UI elements and improve load time.


---

## **Refactoring Ideas**

### **Centralized Configuration**

- **Idea**:
  - Consolidate NavBar configurations (e.g., links, roles) into a single JSON file.
- **Benefit**:
  - Simplify updates and support dynamic configuration.

### **Improved Testing**

- **Idea**:
  - Expand test cases to include user role-specific scenarios.
- **Benefit**:
  - Ensure coverage for all user flows, reducing regressions.

---
