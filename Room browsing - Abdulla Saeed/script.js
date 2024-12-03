// Fetch room data from PHP backend
async function fetchRoomData() {
  try {
    const response = await fetch("http://localhost/ITCS333/ITCS333-PROJECT/Room%20browsing%20-%20Abdulla%20Saeed/getRooms.PHP");
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Error fetching room data:", error);
    return [];
  }
}

// Render rooms in grid layout
async function renderRooms(department, floor) {
  const roomData = await fetchRoomData();

  // Clear previous content
  const roomGrid = document.getElementById("roomGrid");
  roomGrid.innerHTML = "";

  // Filter rooms based on selected department and floor
  const filteredRooms = roomData.filter(
    (room) => room.room_department === department && room.room_floor === parseInt(floor)
  );

  // Render each room
  filteredRooms.forEach((room) => {
    const roomDiv = document.createElement("div");
    roomDiv.className = `room available`;
    roomDiv.innerHTML = `
      <strong>${room.room_name}</strong><br>
      Capacity: ${room.capacity}<br>
      Equipment: ${room.equipment}
    `;

    // Add click event for room details
    roomDiv.addEventListener("click", () => {
      alert(
        `Room Name: ${room.room_name}\nCapacity: ${room.capacity}\nEquipment: ${room.equipment}`
      );
    });

    roomGrid.appendChild(roomDiv);
  });
}

// Handle date and time submission
const submitDateTime = document.getElementById("submitDateTime");
const datePicker = document.getElementById("datePicker");
const roomOverview = document.getElementById("roomOverview");
const selectedDateTime = document.getElementById("selectedDateTime");
const areaSelector = document.getElementById("areaSelector");
const floorSelector = document.getElementById("floorSelector");

submitDateTime.addEventListener("click", () => {
  const date = document.getElementById("date").value;
  const time = document.getElementById("time").value;

  if (!date || !time) {
    alert("Please select a date and time.");
    return;
  }

  // Hide date picker and show room overview
  datePicker.classList.add("hidden");
  roomOverview.classList.remove("hidden");

  // Display selected date and render initial room grid
  selectedDateTime.textContent = `Selected Date & Time: ${date} ${time}`;
  renderRooms(areaSelector.value, floorSelector.value);
});

// Update rooms on department or floor change
areaSelector.addEventListener("change", () => {
  renderRooms(areaSelector.value, floorSelector.value);
});

floorSelector.addEventListener("change", () => {
  renderRooms(areaSelector.value, floorSelector.value);
});
