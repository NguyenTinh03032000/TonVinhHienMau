<table class="table table-bordered sorted_table">
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
        </tr>
        <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
        </tr>
        <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
        </tr>
    </tbody>
</table>

<style>
    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
        background: grey;
    }
</style>

<script>
    $(function() {
        // Sortable rows
        $('.sorted_table').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            placeholder: '<tr class="placeholder"/>'
        });

        // Sortable column heads
        var oldIndex;
        $('.sorted_head tr').sortable({
            containerSelector: 'tr',
            itemSelector: 'th',
            placeholder: '<th class="placeholder"/>',
            vertical: false,
            onDragStart: function($item, container, _super) {
                oldIndex = $item.index();
                $item.appendTo($item.parent());
                _super($item, container);
            },
            onDrop: function($item, container, _super) {
                var field,
                    newIndex = $item.index();

                if (newIndex != oldIndex) {
                    $item.closest('table').find('tbody tr').each(function(i, row) {
                        row = $(row);
                        if (newIndex < oldIndex) {
                            row.children().eq(newIndex).before(row.children()[oldIndex]);
                        } else if (newIndex > oldIndex) {
                            row.children().eq(newIndex).after(row.children()[oldIndex]);
                        }
                    });
                }

                _super($item, container);
            }
        });
    });
</script>