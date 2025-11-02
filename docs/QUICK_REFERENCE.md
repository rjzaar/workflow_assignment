# Workflow Assignment Module - Quick Reference

## 🚀 Quick Start

### Installation (3 steps)
```bash
# 1. Extract
tar -xzf workflow_assignment-1.0.0-fixed.tar.gz

# 2. Move to Drupal
mv workflow_assignment /path/to/drupal/modules/custom/

# 3. Enable
drush en workflow_assignment -y && drush cr
```

### First Use (4 steps)
1. **Configure**: `/admin/config/workflow/workflow-assignment`
2. **Add Resources**: `/admin/structure/taxonomy/manage/resource_locations`
3. **Set Permissions**: `/admin/people/permissions`
4. **Create Workflow**: `/admin/structure/workflow-list` → Click "Add Workflow List"

---

## 🔧 What's Fixed

✅ **Add button now appears** on workflow list page  
✅ All entity routes properly configured  
✅ Local actions correctly defined  
✅ Enhanced list display with counts  
✅ Quick Edit feature added  

---

## 📍 Important URLs

| Page | URL |
|------|-----|
| Workflow List | `/admin/structure/workflow-list` |
| Add Workflow | `/admin/structure/workflow-list/add` |
| Settings | `/admin/config/workflow/workflow-assignment` |
| Resource Terms | `/admin/structure/taxonomy/manage/resource_locations` |
| Permissions | `/admin/people/permissions` |

---

## 🎯 Quick Tasks

### Create a Workflow
```
Structure → Workflow Lists → Add Workflow List
├── Name: "Project Alpha"
├── Description: "Q1 2025 Project"
├── Users: Select team members
├── Groups: Select groups (if available)
└── Resources: Tag locations
```

### Assign to Content
**Method 1:** Edit content → Select workflow from field  
**Method 2:** View content → "Assign Workflow" tab

### Quick Edit
```
Structure → Workflow Lists → Quick Edit (on any workflow)
```

---

## 🔐 Permissions

| Permission | Who Needs It |
|-----------|--------------|
| Administer workflow lists | Administrators |
| Assign workflow lists to content | Content Editors |
| View workflow list assignments | All Users |

---

## 🐛 Troubleshooting

**Problem:** Add button not showing  
**Solution:** `drush cr && drush router:rebuild`

**Problem:** Workflow field missing on content  
**Solution:** Enable content type in module settings

**Problem:** Can't see workflows  
**Solution:** Check permissions at `/admin/people/permissions`

**Problem:** Resource vocabulary missing  
**Solution:** Create at `/admin/structure/taxonomy/add`

---

## 💻 Code Examples

### Create Workflow (PHP)
```php
use Drupal\workflow_assignment\Entity\WorkflowList;

$workflow = WorkflowList::create([
  'id' => 'project_alpha',
  'label' => 'Project Alpha',
  'description' => 'Q1 2025 Project',
]);
$workflow->addAssignedUser(5);
$workflow->addResourceTag(10);
$workflow->save();
```

### Assign to Content
```php
$node->set('field_workflow_list', 'project_alpha');
$node->save();
```

### Load and Modify
```php
$workflow = WorkflowList::load('project_alpha');
$workflow->addAssignedUser(12);
$workflow->removeAssignedUser(5);
$workflow->save();
```

---

## 📦 Package Contents

```
workflow_assignment/
├── 📄 *.info.yml         - Module definition
├── 📄 *.module           - Main module file
├── 📄 *.install          - Installation hooks
├── 📄 *.routing.yml      - URL routes
├── 📄 *.links.*.yml      - Menu/action links
├── 📄 *.permissions.yml  - Access control
├── 📄 *.libraries.yml    - CSS/JS assets
├── 📁 src/
│   ├── Entity/           - WorkflowList entity
│   └── Form/             - All forms
├── 📁 templates/         - Twig templates
├── 📁 css/              - Stylesheets
├── 📄 README.md          - Full documentation
└── 📄 CHANGELOG.md       - Version history
```

---

## 🎨 Display Options

### On Content View
When a workflow is assigned, users see:
```
Workflow Information
├── Workflow: "Project Alpha"
├── Description: "Q1 2025 Project"
├── Assigned Users: (list)
├── Assigned Groups: (list)
└── Resource Locations: (list)
```

### Admin List View
```
Workflow Lists
├── [Add Workflow List] ← Button now works!
└── Table:
    ├── Name
    ├── Machine name
    ├── Description
    ├── Users (count)
    ├── Groups (count)
    ├── Resources (count)
    └── Operations: Edit | Quick Edit | Delete
```

---

## 🔄 Workflow Actions

| Action | Access |
|--------|--------|
| Create | Admin interface or API |
| Read | View content with workflow |
| Update | Full edit or Quick edit |
| Delete | Admin interface |
| Assign | Content edit form |

---

## ⚡ Performance

- **Cache**: Entity cached as config
- **Database**: Minimal queries
- **Size**: ~12KB compressed
- **Load Time**: Negligible
- **Memory**: Low footprint

---

## 🔗 Integration

**Works with:**
- ✅ Drupal Core
- ✅ Group Module
- ✅ Open Social
- ✅ Content Moderation
- ✅ Workflows (core)

**API:**
- Full programmatic access
- RESTful endpoints (via core)
- GraphQL compatible

---

## 📞 Support Checklist

Before asking for help:
- [ ] Cleared cache (`drush cr`)
- [ ] Checked permissions
- [ ] Verified module enabled
- [ ] Read README.md
- [ ] Checked error logs

---

## 🎓 Learning Resources

1. **Module README** - Complete feature guide
2. **CHANGELOG** - What's new/fixed
3. **INSTALL.md** - Detailed setup
4. **TECHNICAL_FIX_SUMMARY** - Developer deep-dive
5. **Drupal.org** - Community support

---

## ✅ Verification Checklist

After installation:
- [ ] Add button appears on list page
- [ ] Can create new workflow
- [ ] Can assign to content
- [ ] Can see workflow info on content
- [ ] Quick Edit works
- [ ] Permissions function correctly

---

## 🚨 Important Notes

⚠️ **Always backup** before installing/updating  
⚠️ **Clear cache** after configuration changes  
⚠️ **Test permissions** in different roles  
⚠️ **Review README** for full documentation  

---

**Module Version:** 1.0.0-fixed  
**Drupal Version:** 10.x, 11.x  
**Status:** Production Ready  
**License:** GPL-2.0+  

---

## 🎉 Success!

Your workflow assignment system is ready to use!

**Next Steps:**
1. Create resource location terms
2. Configure enabled content types  
3. Set up permissions
4. Create your first workflow
5. Start assigning to content

**Need Help?** Check README.md for detailed documentation.
