function collection(collectionName) {
  this.name = collectionName;
  this.find = (restraints, sort, callback) => {
    ajax_request(this.name, "find", restraints, sort, (res) => {
      if(res == "error"){
        console.warn("Error finding results");
      } else {
        callback(JSON.parse(res));
      }
    });
  };
  this.findOne = (restraints, callback) => {
    ajax_request(this.name, "findOne", restraints, {}, (res) => {
      if(res == "error"){
        console.warn("Error finding result");
      } else {
        callback(JSON.parse(res));
      }
    });
  };
  this.insert = (data, callback) => {
    ajax_insert(this.name, data, (res) => {
      callback(res);
    });
  }
}
