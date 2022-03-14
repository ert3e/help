window.sortableInitialIndexes = {};
window.routesSortable = {};
window.sortableCounter = {};

window.enableDragSort = function(listClass, routeSortable, key = 'defaultKey') {
    const sortableLists = document.getElementsByClassName(listClass);

    window.routesSortable[key] = routeSortable;
    window.sortableCounter[key] = 0;
    window.sortableInitialIndexes[key] = {};

    Array.prototype.map.call(sortableLists, (list) => {enableDragList(list)});
}

function getSortableTableKey(element) {
    var key = 'defaultKey';

    [].forEach.call(element.parents('.sortable-table'), function(table)  {
        if (table.dataset.sortableKey)
            key = table.dataset.sortableKey;
    });

    return key;
}

function enableDragList(list) {
    Array.prototype.map.call(list.children, (item) => {enableDragItem(item)});
}

function enableDragItem(item) {
    item.setAttribute('draggable', true);
    item.ondrag = handleDrag;
    item.ondragend = handleDrop;

    const sortableKey = getSortableTableKey(item);
    const counter = window.sortableCounter[sortableKey];

    window.sortableInitialIndexes[sortableKey][counter] = item.dataset.key;
    window.sortableCounter[sortableKey]++;
}

function handleDrag(item) {
    const selectedItem = item.target,
        list = selectedItem.parentNode,
        x = event.clientX,
        y = event.clientY;

    if (item.target.tagName == 'A') {
        return false;
    }

    selectedItem.classList.add('drag-sort-active');

    let hoverElement = document.elementFromPoint(x, y),
        swapItem;

    if (selectedItem.parentNode.tagName == 'TBODY' && hoverElement.tagName != 'TR') {
        [].forEach.call(hoverElement.parents('tr'), (element) => {
            swapItem = element;
        });
    } else {
        swapItem = document.elementFromPoint(x, y).parentNode === null ? selectedItem : document.elementFromPoint(x, y).parentNode;
    }

    if (swapItem != undefined && list === swapItem.parentNode) {
        swapItem = swapItem !== selectedItem.nextSibling ? swapItem : swapItem.nextSibling;
        list.insertBefore(selectedItem, swapItem);
    }
}

function handleDrop(item) {
    item.target.classList.remove('drag-sort-active');

    let i = 0,
        sortedItems = {};

    const sortableKey = getSortableTableKey(item.target);

    [].forEach.call(item.target.parents('.sortable-table'), (element) => {

        element.querySelectorAll('tr').forEach(function (item) {
            let currentKey = item.dataset.key;

            if (window.sortableInitialIndexes[sortableKey][i] != currentKey) {
                sortedItems[currentKey] = window.sortableInitialIndexes[sortableKey][i];
                window.sortableInitialIndexes[sortableKey][i] = currentKey;
            }
            ++i;
        });
    });


    axios.post(window.routesSortable[sortableKey], {
        'items': JSON.stringify(sortedItems)
    }).catch(() => alert('Произошла ошибка. Пожалуйста повторите еще раз!'));

}
