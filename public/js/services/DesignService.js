(function(){
	angular.module('Check-in').factory('Designs', ['DesignsResource', function(DesignsResource){
		var designs = {
			all: {},
			
			read: function(design){
				var promise = DesignsResource.read(design).$promise;
				promise.then(function(response){
					angular.merge(design, response);
					designs.all[design.id] = design;
				});

				return promise;
			},

			update: function(design){
				var promise = DesignsResource.update(design).$promise;
				promise.then(function(response){

				});

				return promise;
			},

			delete: function(design){
				var promise = DesignsResource.delete(design).$promise;
				delete designs.all[design.id];

				return promise;
			}
		};
		return resource;
	}]);
})();