var myApp = angular.module("myApp", []).config(function($interpolateProvider){
  $interpolateProvider.startSymbol("{[{").endSymbol("}]}");
});

myApp.controller('MainCtrl', ['$scope', '$http', function ($scope, $http) {

  $scope.getMessages = [];
  $http.get('/get-messages').then(function(res) {
    $scope.getMessages = res.data;
    setTimeout(function(){$scope.autoScroll();}, 100);
  });


  $scope.getNewMessages = function() {
    var ids = [];

    for (var indexElement in $scope.getMessages) {
      ids.push($scope.getMessages[indexElement].id);
    }

    var lastId = Math.max.apply(null, ids);
    $http.get('/get-new-messages/' + lastId).then(function(res) {
      if (res.data.status === undefined) {
        for (index in res.data) {
          $scope.getMessages.push(
            {
              id: res.data[index].id,
              user: res.data[index].user,
              message: res.data[index].message
            });
        }
        setTimeout(function(){$scope.autoScroll();}, 100);
      }
    });
  };

  $scope.autoScroll = function() {
    objDiv = document.getElementById("chat");
    objDiv.scrollTop = objDiv.scrollHeight;
  };

  setInterval(function(){
    $scope.getNewMessages();
  }, 1000);
}]);

myApp.controller('SendMessage', ['$scope', '$http', function($scope, $http) {
  $scope.send = function() {
    $scope.sendMessage = [];
    $http.post('/save-message', $scope.messageData).then(function(res) {
      // if (res.data.status === 'ok') {
      //   setTimeout(function(){$scope.messageData = null;}, 100);
      // }
      // $scope.messageData = null; //todo стирать сообщение с инпута после отправки
    });
  };

}]);

myApp.controller('Users', ['$scope', '$http', function($scope, $http) {
  $scope.getUsersOnline = function() {
    $scope.users = [];
    $http.get('/get-users').then(function(res) {
      $a = 5;
      if (res.data !== undefined && $scope.users !== res.data) {
        for (index in res.data) {
          $scope.users.push(
            {
              name: res.data[index].name
            });
        }
    }})
  };
  //todo написати додавання і видалення юзерів на фронті
  //todo + підправити статуси на бекові

  setInterval(function(){
    $scope.getUsersOnline();
  }, 3000);
}]);
