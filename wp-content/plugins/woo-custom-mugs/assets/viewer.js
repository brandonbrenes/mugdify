let scene, camera, renderer, controls, tazaMesh, texture;

function initViewer() {
  const canvas = document.getElementById('tazaCanvas');
  if (!canvas) return;

  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(50, canvas.clientWidth / canvas.clientHeight, 0.1, 1000);
  camera.position.z = 2;

  renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
  renderer.setSize(canvas.clientWidth, canvas.clientHeight);

  controls = new THREE.OrbitControls(camera, renderer.domElement);

  const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1.2);
  scene.add(light);

  const loader = new THREE.GLTFLoader();
  loader.load('/wp-content/plugins/producto-personalizable/assets/taza.glb', function (gltf) {
    tazaMesh = gltf.scene;
    tazaMesh.scale.set(1.5, 1.5, 1.5);
    scene.add(tazaMesh);
    animate();
  });

  const uploadInput = document.querySelector('input[name="imagen_personalizada"]');
  if (uploadInput) {
    uploadInput.addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (ev) {
          const img = new Image();
          img.onload = () => {
            texture = new THREE.Texture(img);
            texture.needsUpdate = true;

            if (tazaMesh) {
              tazaMesh.traverse(child => {
                if (child.isMesh) {
                  child.material.map = texture;
                  child.material.needsUpdate = true;
                }
              });
            }
          };
          img.src = ev.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  }
}

function animate() {
  requestAnimationFrame(animate);
  renderer.render(scene, camera);
}

window.addEventListener('DOMContentLoaded', initViewer);

