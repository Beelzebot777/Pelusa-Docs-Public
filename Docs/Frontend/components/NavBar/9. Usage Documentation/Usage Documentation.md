# **Usage Documentation**

## **Implementation Examples**
- Provide examples of how to use the `NavBar` component in the application:
  ```jsx
  import NavBarContainer from './containers/NavBarContainer';

  const App = () => {
      return (
          <div>
              <NavBarContainer />
          </div>
      );
  };
  export default App;
  ```

## **Component API**
| Prop Name          | Type     | Description                                                     | Default  |
|--------------------|----------|-----------------------------------------------------------------|----------|
| `tabs`            | Array    | Array of tab objects with `name`, `icon`, `route`, and `disabled` fields. | `[]`     |
| `selectedTab`     | Number   | Index of the currently selected tab.                           | `0`      |
| `handleTabChange` | Function | Callback to handle tab selection changes.                      | `null`   |

### Tab Object Structure
| Field       | Type     | Description                                          |
|-------------|----------|------------------------------------------------------|
| `name`      | String   | The name of the tab displayed to the user.          |
| `icon`      | String   | Path to the icon image for the tab.                 |
| `route`     | String   | The route navigated to when the tab is selected.    |
| `disabled`  | Boolean  | If true, the tab is disabled and not clickable.     |

## **Notes and Warnings**
- Ensure that:
  - The `tabs` prop is not null or undefined; otherwise, the component may render incorrectly.
  - Each tab object contains valid `name`, `icon`, and `route` fields for correct functionality.
  - When providing a `handleTabChange` callback, ensure it updates the state or navigates properly.

### Example Tab Object Array
```javascript
const tabs = [
    { name: 'Alarms', icon: '/path/to/icon.svg', route: '/alarms', disabled: false },
    { name: 'Orders', icon: '/path/to/icon.svg', route: '/orders', disabled: true },
    { name: 'Strategies', icon: '/path/to/icon.svg', route: '/strategies', disabled: false },
];
```

### Styling
- Custom Tailwind CSS classes are used:
  - Active tabs: `bg-african_violet-400 text-african_violet-900`
  - Inactive tabs: `bg-african_violet-200 text-african_violet-700`
  - Disabled tabs: `cursor-not-allowed bg-gray-500 text-gray-500`
- Ensure these styles align with the overall theme defined in the project's UI guide.

### Navigation
- The `handleTabChange` function should:
  - Prevent navigation for disabled tabs.
  - Update the Redux state to reflect the selected tab.

## **Behavior Flow**
1. **Tab Interaction**:
   - User clicks on an active tab.
   - If `handleTabChange` is provided, it triggers the callback.
   - Navigates to the corresponding route using `useNavigate`.

2. **Disabled Tabs**:
   - User clicks on a disabled tab.
   - No navigation occurs; the `cursor-not-allowed` style prevents unintended clicks.

3. **Dynamic Tabs**:
   - If tabs need to be updated dynamically, pass a new `tabs` array to the `NavBarContainer`.
   - Ensure Redux state or local state updates reflect the new configuration.

## **Testing**
- Test Cases:
  1. Renders the correct number of tabs based on the `tabs` prop.
  2. Navigates to the correct route on tab click.
  3. Applies the correct styling for active, inactive, and disabled tabs.
  4. Does not navigate when a disabled tab is clicked.

- Testing Tools:
  - **React Testing Library**: For DOM interaction testing.
  - **Jest**: For unit tests.

### Example Test Code
```javascript
import { render, screen, fireEvent } from '@testing-library/react';
import NavBar from '../NavBar';

test('should render all tabs', () => {
    const tabs = [
        { name: 'Alarms', icon: '/alarms.svg', route: '/alarms', disabled: false },
        { name: 'Orders', icon: '/orders.svg', route: '/orders', disabled: true },
    ];
    render(<NavBar tabs={tabs} selectedTab={0} handleTabChange={() => {}} />);
    expect(screen.getByText('Alarms')).toBeInTheDocument();
    expect(screen.getByText('Orders')).toBeInTheDocument();
});

```

