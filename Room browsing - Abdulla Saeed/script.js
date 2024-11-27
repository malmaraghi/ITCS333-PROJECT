const roomData = [{ id: "ITIS-101", area: "ITIS", floor: 1, status: "available", type: "Class" },
{ id: "ITIS-102", area: "ITIS", floor: 1, status: "occupied", type: "Lab" },
{ id: "ITIS-103", area: "ITIS", floor: 1, status: "unavailable", type: "Class" },
{ id: "ITIS-201", area: "ITIS", floor: 2, status: "available", type: "Lab" },
{ id: "ITIS-202", area: "ITIS", floor: 2, status: "occupied", type: "Class" },
{ id: "ITIS-301", area: "ITIS", floor: 3, status: "unavailable", type: "Lab" },
{ id: "ITIS-302", area: "ITIS", floor: 3, status: "available", type: "Class" },
{ id: "ITIS-303", area: "ITIS", floor: 3, status: "available", type: "Lab" },
{ id: "ITIS-304", area: "ITIS", floor: 3, status: "occupied", type: "Class" },
{ id: "ITIS-305", area: "ITIS", floor: 3, status: "unavailable", type: "Lab" },
{ id: "ITCS-101", area: "ITCS", floor: 1, status: "occupied", type: "Class" },
{ id: "ITCS-102", area: "ITCS", floor: 1, status: "available", type: "Lab" },
{ id: "ITCS-201", area: "ITCS", floor: 2, status: "unavailable", type: "Class" },
{ id: "ITCS-202", area: "ITCS", floor: 2, status: "available", type: "Lab" },
{ id: "ITCS-301", area: "ITCS", floor: 3, status: "occupied", type: "Class" },
{ id: "ITCS-302", area: "ITCS", floor: 3, status: "available", type: "Lab" },
{ id: "ITCS-303", area: "ITCS", floor: 3, status: "available", type: "Class" },
{ id: "ITCS-304", area: "ITCS", floor: 3, status: "occupied", type: "Lab" },
{ id: "ITCS-305", area: "ITCS", floor: 3, status: "unavailable", type: "Class" },
{ id: "ITCE-101", area: "ITCE", floor: 1, status: "available", type: "Lab" },
{ id: "ITCE-102", area: "ITCE", floor: 1, status: "unavailable", type: "Class" },
{ id: "ITCE-103", area: "ITCE", floor: 1, status: "occupied", type: "Lab" },
{ id: "ITCE-201", area: "ITCE", floor: 2, status: "available", type: "Class" },
{ id: "ITCE-202", area: "ITCE", floor: 2, status: "occupied", type: "Lab" },
{ id: "ITCE-203", area: "ITCE", floor: 2, status: "unavailable", type: "Class" },
{ id: "ITCE-301", area: "ITCE", floor: 3, status: "available", type: "Lab" },
{ id: "ITCE-302", area: "ITCE", floor: 3, status: "occupied", type: "Class" },
{ id: "ITCE-303", area: "ITCE", floor: 3, status: "available", type: "Lab" },
{ id: "ITCE-304", area: "ITCE", floor: 3, status: "unavailable", type: "Class" }
  ,];

const datePicker = document.getElementById("datePicker");
const roomOverview = document.getElementById("roomOverview");
const submitDateTime = document.getElementById("submitDateTime");
const selectedDateTime = document.getElementById("selectedDateTime");
const roomGrid = document.querySelector(".room-grid");
const areaButtons = document.getElementById("areaButtons");
const floorButtons = document.getElementById("floorButtons");
const roomInfoModal = document.getElementById("roomInfoModal");
const roomInfo = document.getElementById("roomInfo");
const closeModal = document.querySelector(".close");

let selectedArea = "ITIS";
let selectedFloor = 1;

function renderRooms(area, floor) {
  roomGrid.innerHTML = "";

  const filteredRooms = roomData.filter(
    (room) => room.area === area && room.floor === parseInt(floor)
  );

  filteredRooms.forEach((room) => {
    const roomDiv = document.createElement("div");
    roomDiv.className = `room ${room.status}`;
    roomDiv.textContent = room.id;
    roomDiv.style.top = room.top;
    roomDiv.style.left = room.left;

    roomDiv.addEventListener("click", () => {
      displayRoomInfo(room);
    });

    roomGrid.appendChild(roomDiv);
  });
}

submitDateTime.addEventListener("click", () => {
  const date = document.getElementById("date").value;
  const time = document.getElementById("time").value;

  if (!date || !time) {
    alert("Please select a date and time.");
    return;
  }

  datePicker.classList.add("hidden");
  roomOverview.classList.remove("hidden");

  selectedDateTime.textContent = `Selected Date & Time: ${date} ${time}`;
  renderRooms(selectedArea, selectedFloor);
});

areaButtons.addEventListener("click", (event) => {
  if (event.target.tagName === "BUTTON") {
    selectedArea = event.target.dataset.area;
    renderRooms(selectedArea, selectedFloor);
  }
});

floorButtons.addEventListener("click", (event) => {
  if (event.target.tagName === "BUTTON") {
    selectedFloor = event.target.dataset.floor;
    renderRooms(selectedArea, selectedFloor);
  }
});

function displayRoomInfo(room) {
  roomInfo.textContent = `ID: ${room.id}\nArea: ${room.area}\nFloor: ${room.floor}\nStatus: ${room.status}\nType: ${room.type}`;
  roomInfoModal.classList.remove("hidden");
}

close