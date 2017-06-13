(function () {
  'use strict'

  angular.module('App', [])
.controller('ApppController', ApppController)
.service('AppService', AppService)
.constant('ApiBasePath', 'http://localhost/service_php')

  ApppController.$inject = ['AppService']
  function ApppController (AppService) {
    var menu = this

    var promise = AppService.getMenuCategories()

    promise.then(function (response) {
      menu.categories = response.data.records
      console.log(response.data.records)
      
    })
  .catch(function (error) {
    console.log('Something went terribly wrong.')
  })
 menu.logMenuItems = function (shortName) {
      var promise = AppService.getMenuForCategory(shortName)

      promise.then(function (response) {
        console.log(response.data.records)
      })
    .catch(function (error) {
      console.log(error)
    })
    }
   
  }

  AppService.$inject = ['$http', 'ApiBasePath']
  function AppService ($http, ApiBasePath) {
    var service = this

    service.getMenuCategories = function () {
      var response = $http({
        method: 'GET',
        url: (ApiBasePath + '/data.php')
      })

      return response

    }

    service.getMenuForCategory = function (id) {
      var response = $http({
        method: 'GET',
        url: (ApiBasePath + '/data.php'),
        params: {
          id_users : id
        }
      })

      return response
    }

    
  }
})()
