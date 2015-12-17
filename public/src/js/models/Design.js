(function(){
	angular.module('Check-in').factory('Design', ['DesignResource', function(DesignResource){
		Design = function(model, project){
			angular.extend(this, model);
			this.project = project;
		};

		Design.prototype = {
			constructor: Design,

			save: function(){
				var promise = DesignResource.update(this).$promise;
				promise.then(function(response){
					// angular.extend(this, response);
					debugger;
				});

				return promise;
			},

			delete: function(){
				var promise = DesignResource.delete({ // needed because otherwise the whole object is sent via query parameters, since DELETE doesn't post-param things like POST.
					id: this.id
				}).$promise;
				
				promise.then(function(response){
					// delete project.designs[this.id];
					debugger;
				});

				return promise;
			}
		};

		return Design;
	}]);
})();