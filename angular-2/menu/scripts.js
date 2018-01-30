menuBar = angular.module('MenuBar', []);

menuBar.controller('CreateController', function ($scope) {
    $scope.menuList = [
        {name: 'File', subList:[
            {name: 'New File', icon: 'fa-file'},
            {name: 'Save file', icon: 'fa-floppy-o'},
            {name: 'Open', icon: 'fa-folder-open-o'},
        ]},
        {name: 'Edit', subList:[
            {name: 'Cut', icon: 'fa-scissors'},
            {name: 'Copy', icon: 'fa-clone'},
            {name: 'Paste', icon: 'fa-clipboard'},
        ]},
        {name: 'Insert', subList:[
            {name: 'Full screen', icon: 'fa-arrows-alt'},
            {name: 'Print layout', icon: 'fa-print'},
            {name: 'Presentation', icon: 'fa-newspaper-o'},
        ]},
        {name: 'Format', subList:[
            {name: 'Bold', icon: 'fa-bold'},
            {name: 'Italic', icon: 'fa-italic'},
            {name: 'Underline', icon: 'fa-underline'},
        ]},
        {name: 'Table', subList:[
            {name: 'Add row', icon: 'fa-plus'},
            {name: 'Remove row', icon: 'fa-minus'},
        ]},
    ];

});

