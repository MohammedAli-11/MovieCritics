<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<script>
  let movies = []
  try {
    movies = JSON.parse(`<?php echo json_encode($movies); ?>`)
  } catch (e) {}
  let livesearch = document.getElementById('livesearch')
  let password = document.getElementById('password')
  let signup = document.getElementById('signup')
  let passError = document.getElementById('pass-error')


  try {
    signup.addEventListener('click', (e) => {
      if (!checkPassword(password.value)) {
        e.preventDefault();
        passError.style.display = 'block';
      } else {
        passError.style.display = 'none';
      }
    })
  } catch (e) {}

  // function sendQuery(str) {
  //   if (str.length == 0) {
  //     document.getElementById('livesearch').innerHTML = ''
  //     document.getElementById('livesearch').style.border = '0px'
  //     return
  //   }
  //   var xmlhttp = new XMLHttpRequest()
  //   xmlhttp.onreadystatechange = function() {
  //     if (this.readyState == 4 && this.status == 200) {
  //       document.getElementById('livesearch').innerHTML = this.responseText
  //     }
  //   }
  //   xmlhttp.open('GET', 'https://cse-482.000webhostapp.com/database/movie_list.src.php?q=' + str, true)
  //   xmlhttp.send()
  // }

  function search(arr, sub) {
    sub = sub.toLowerCase();
    return arr.map(str => str
      .toLowerCase()
      .startsWith(sub.slice(0, Math.max(str.length - 1, 1)))
    );
  }

  function checkPassword(str) {
    // min 8 letter password, with at least a symbol, upper and lower case letters and a number
    var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return re.test(str);
  }

  function handleSearch(query) {
    const filteredMovies = movies.filter(item => {
      let parsedQuery = query.toLowerCase()
      let parsedName = item[1].toLowerCase()
      // return parsedName.startsWith(parsedQuery.slice(0, Math.max(parsedQuery.length - 1, 1)))
      return parsedName.startsWith(parsedQuery)
    })

    if (query && !filteredMovies.length) {
      livesearch.innerHTML = '<div style="color: white; text-align: center; width: 100%;">No movies found!</div>'
    }

    if (!query) {
      let htmlText = ''
      for (let movie of movies) {
        let id = movie[0];
        let name = movie[1];
        let genre = movie[2];
        let release_year = movie[3];
        let image = movie[4];
        let likes = movie[6];
        htmlText +=
          `
            <a href="http://localhost/projects/project/pages/movie_details.php?id=${id}" class="col" style="max-width: 300px; text-decoration: none; color: black;">
              <div class="card movie-card">
                <div style="width: 100%;">
                  <div style="overflow: hidden; position: relative; width: 100%; padding-bottom: 95%;">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                      <img src="http://localhost/projects/project/${image.slice(3)}" alt="" style="object-fit: cover; height: 100%; width: 100%;" />
                    </div>
                  </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center gap-2">
                  <h6 class="card-title fs-5"> ${name}</h6>
                  <div class="d-flex align-items-center justify-content-center w-100 gap-2" style="color: #545454; font-size: 0.9rem;">
                    <span><i class="bi bi-calendar"></i> ${release_year}</span>
                    <span>•</span>
                    <span><i class="bi bi-tag"></i> ${genre}</span>
                    <span>•</span>
                    <span><i class="bi bi-hand-thumbs-up"></i> ${likes}</span>
                  </div>
                </div>
              </div>
            </a>
            `
      }
      livesearch.innerHTML = htmlText
      return
    }

    if (filteredMovies.length) {
      let htmlText = ''

      for (let movie of filteredMovies) {
        let id = movie[0];
        let name = movie[1];
        let genre = movie[2];
        let release_year = movie[3];
        let image = movie[4];
        let likes = movie[6];

        htmlText +=
          `
            <a href="http://localhost/projects/project/pages/movie_details.php?id=${id}" class="col" style="max-width: 300px; text-decoration: none; color: black;">
              <div class="card movie-card">
                <div style="width: 100%;">
                  <div style="overflow: hidden; position: relative; width: 100%; padding-bottom: 95%;">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                      <img src="http://localhost/projects/project/${image.slice(3)}" alt="" style="object-fit: cover; height: 100%; width: 100%;" />
                      </div>
                      </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center gap-2">
                <h6 class="card-title fs-5"> ${name}</h6>
                <div class="d-flex align-items-center justify-content-center w-100 gap-2" style="color: #545454; font-size: 0.9rem;">
                    <span><i class="bi bi-calendar"></i> ${release_year}</span>
                    <span>•</span>
                    <span><i class="bi bi-tag"></i> ${genre}</span>
                    <span>•</span>
                    <span><i class="bi bi-hand-thumbs-up"></i> ${likes}</span>
                    </div>
                    </div>
              </div>
              </a>
            `
      }

      livesearch.innerHTML = htmlText
      return
    }
  }
</script>
</body>

</html>