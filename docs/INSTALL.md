# Workflow Assignment Module - Fixed Version
## Installation Guide

### What's Fixed
This version resolves the missing "Add Workflow List" button issue on `/admin/structure/workflow-list`

**Key Fixes:**
- ✅ Added proper `add-form` link in entity annotation
- ✅ Configured `AdminHtmlRouteProvider` for automatic route generation
- ✅ Created local action file for the Add button
- ✅ Updated list builder with proper render method
- ✅ Complete routing configuration

### Quick Install

1. **Extract the archive:**
   ```bash
   tar -xzf workflow_assignment-1.0.0-fixed.tar.gz
   ```

2. **Move to Drupal modules directory:**
   ```bash
   mv workflow_assignment /path/to/drupal/modules/custom/
   ```

3. **Enable the module:**
   ```bash
   drush en workflow_assignment -y
   drush cr
   ```

4. **Verify the fix:**
   - Navigate to: `/admin/structure/workflow-list`
   - You should now see the "Add Workflow List" button at the top

### Initial Configuration

1. **Configure Settings:**
   - Go to: `/admin/config/workflow/workflow-assignment`
   - Enable the content types you want to use
   - Select the resource location vocabulary

2. **Create Resource Locations:**
   - Go to: `/admin/structure/taxonomy/manage/resource_locations`
   - Add terms like: "Google Drive", "GitHub", "SharePoint", etc.

3. **Set Permissions:**
   - Go to: `/admin/people/permissions`
   - Grant appropriate permissions:
     - "Administer workflow lists" (for admins)
     - "Assign workflow lists to content" (for editors)
     - "View workflow list assignments" (for viewers)

4. **Create Your First Workflow:**
   - Go to: `/admin/structure/workflow-list`
   - Click: "Add Workflow List"
   - Fill in the form and save

### Files Included

```
workflow_assignment/
├── workflow_assignment.info.yml
├── workflow_assignment.module
├── workflow_assignment.install
├── workflow_assignment.routing.yml
├── workflow_assignment.permissions.yml
├── workflow_assignment.links.menu.yml
├── workflow_assignment.links.action.yml (NEW - fixes Add button)
├── workflow_assignment.links.task.yml
├── workflow_assignment.libraries.yml
├── README.md (comprehensive documentation)
├── CHANGELOG.md (fix details)
├── css/
│   └── workflow_assignment.css
├── templates/
│   └── workflow-info.html.twig
└── src/
    ├── Entity/
    │   ├── WorkflowList.php (FIXED annotations)
    │   └── WorkflowListInterface.php
    ├── Form/
    │   ├── WorkflowListForm.php
    │   ├── QuickEditWorkflowForm.php
    │   ├── SettingsForm.php
    │   └── NodeAssignWorkflowForm.php
    └── WorkflowListListBuilder.php (FIXED render method)
```

### Testing the Fix

1. **Test Add Button:**
   ```bash
   # After installation, visit:
   /admin/structure/workflow-list
   
   # You should see:
   # - "Add Workflow List" button at the top
   # - List of existing workflows (if any)
   # - Quick Edit and Edit operations for each workflow
   ```

2. **Test Workflow Creation:**
   - Click "Add Workflow List"
   - Fill in name, description
   - Select users, groups (if Group module enabled)
   - Add resource location tags
   - Save successfully

3. **Test Content Assignment:**
   - Edit any enabled content type
   - See "Workflow List" field
   - Assign a workflow
   - View the content and see workflow info displayed

### Troubleshooting

**If Add button still doesn't appear:**

```bash
# Clear all caches
drush cr

# Rebuild routes
drush router:rebuild

# Check if module is enabled
drush pm:list | grep workflow_assignment

# Verify permissions
drush role:perm:list administrator | grep workflow
```

**Check file permissions:**
```bash
# Ensure Drupal can read the files
chmod -R 755 modules/custom/workflow_assignment
```

**Verify entity annotation:**
```bash
# The WorkflowList entity should have:
# - "add-form" = "/admin/structure/workflow-list/add"
# - "route_provider" with AdminHtmlRouteProvider
```

### Upgrading from Original Version

If you have the original dworkflow installed:

```bash
# Backup your data first!
drush sql:dump > backup.sql

# Uninstall old module (if different name)
drush pmu dworkflow -y

# Install this fixed version
drush en workflow_assignment -y
drush cr
```

### Support

For detailed documentation, see:
- `README.md` - Complete feature documentation
- `CHANGELOG.md` - List of all fixes and changes

### Module Information

- **Version:** 1.0.0-fixed
- **Compatible with:** Drupal 10.x, 11.x
- **Dependencies:** node, taxonomy, user (core modules)
- **Optional:** group module (for Open Social integration)
- **License:** GPL-2.0+

### What's Different from Original

This fixed version includes:

1. **Critical Routing Fix:**
   - Added `workflow_assignment.links.action.yml` (previously missing)
   - Fixed entity `links` annotation with complete URL patterns
   - Added `AdminHtmlRouteProvider` configuration

2. **Enhanced List Builder:**
   - Better column display (users, groups, resources counts)
   - Proper empty message with link
   - Quick Edit operation added

3. **Complete Documentation:**
   - Comprehensive README
   - Detailed CHANGELOG
   - This installation guide

4. **Improved Code Quality:**
   - Proper dependency injection
   - Complete interface definitions
   - Better error handling

### Next Steps

After installation:

1. Create resource location taxonomy terms
2. Configure enabled content types
3. Create your first workflow list
4. Assign workflows to content
5. Test the Quick Edit feature
6. Configure permissions for your team

Enjoy your working workflow assignment system! 🎉
