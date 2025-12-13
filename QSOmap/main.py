import adif_io
import maidenhead as mh
import cartopy.crs as ccrs
import cartopy.feature as cfeature
import matplotlib.pyplot as plt
from matplotlib.patches import Rectangle
from PIL import Image
from pyproj import Geod


ADIF_FILE = './2025-11-29-CQ-WW-CW.adif'
BLUE_MARBLE_IMAGE = './world.200404.3x1200x600.jpg' # https://neo.gsfc.nasa.gov/archive/bluemarble/bmng/world_8km/
OUTPUT_FILE = './2025-11-29-CQ-WW-CW.png'
MY_GRID = 'JO60' #specify your location, 4 or 6 digit grid locator
SAT_ONLY = False
PATH_POINTS = 100 #number of points to plot on the QSO path


def maidenhead_to_latlon(grid, center=True):
    lat, lon = mh.to_location(grid, center)
    return lat, lon

def plot_grid(grid, ax):
    #find the South West corner of the 4 digit grid
    lat_min, lon_min = maidenhead_to_latlon(grid[:4], False)

    #make a rectangle from lon_min, lat_min that is 2 degrees wide and 1 degree tall
    rect = Rectangle((lon_min, lat_min), 2, 1,facecolor='green',edgecolor='darkgreen',linewidth=0.5,alpha=1.0,transform=ccrs.Geodetic())
    ax.add_patch(rect)

def plot_grids(qsos, ax):
    #loop through all of the qsos
    for qso in qsos:

        #are we only looking for satellite QSOs?
        if SAT_ONLY:    
            prop_mode = qso.get('PROP_MODE', 'NONE')
            if prop_mode[:3] != 'SAT':
                continue

        #special case for VHF and up QSOs on a grid line or grid corner
        vucc_grids = qso.get('VUCC_GRIDS', 'NONE')
        if vucc_grids != 'NONE':
            #put all of the grids into a list, loop through the list and plot them
            grids = [grid.strip() for grid in vucc_grids.split(',') if grid.strip()]
            for grid in grids:
                plot_grid(grid, ax)

            #we are done with this qso
            continue

        #make sure we have a valid grid. AA00 gets used as a placeholder when no grid is provided
        #not using "NONE" here because some logging apps will put in AA00 if no grid is specified
        grid_square = qso.get('GRIDSQUARE', 'AA00')
        if grid_square[:4] == 'AA00':
            continue

        #lets plot it
        plot_grid(grid_square, ax)


def plot_path(my_lat, my_lon, lat, lon, ax):
    geod = Geod(ellps='WGS84')

    #create the qso path
    lonlats = geod.npts(my_lon, my_lat, lon, lat, PATH_POINTS)
    lons, lats = zip(*lonlats)

    #plot the path
    ax.plot([my_lon] + list(lons) + [lon], 
            [my_lat] + list(lats) + [lat], 
            'b-', linewidth=1, transform=ccrs.Geodetic(), alpha=0.1)
            #transform=ccrs.Geodetic() converts the points from WGS-84 lat/lon into the projection coordinates

def plot_paths(my_lat, my_lon, qsos, ax):
    #loop through all of the qsos
    for qso in qsos:

        #are we only looking for satellite QSOs?
        if SAT_ONLY:    
            prop_mode = qso.get('PROP_MODE', 'NONE')
            if prop_mode[:3] != 'SAT':
                continue

        #special case for VHF and up QSOs on a grid line or grid corner
        vucc_grids = qso.get('VUCC_GRIDS', 'NONE')
        if vucc_grids != 'NONE':
            lats = []
            lons = []
            
            #make a list of the individual grids
            grids = [grid.strip() for grid in vucc_grids.split(',') if grid.strip()]
            
            #loop through grids, add their lat and lons up
            for grid in grids:
                lat, lon = maidenhead_to_latlon(grid)
                lats.append(lat)
                lons.append(lon)

            #get the average lat and lon
            #this should be on the corner or on the grid line
            avg_lat = sum(lats) / len(lats)
            avg_lon = sum(lons) / len(lons)

            #plot it
            plot_path(my_lat, my_lon, avg_lat, avg_lon, ax)

            #we are done with this qso
            continue

        #make sure we have a valid grid. AA00 gets used as a placeholder when no grid is provided
        #not using "NONE" here because some logging apps will put in AA00 if no grid is specified
        grid_square = qso.get('GRIDSQUARE', 'AA00')
        if grid_square[:4] == 'AA00':
            continue
 
        #get the lat/lon from the grid
        lat, lon = maidenhead_to_latlon(grid_square)

        #plot it
        plot_path(my_lat, my_lon, lat, lon, ax)


def plot_qsos(qsos, ax):
    #loop through all of the qsos
    for qso in qsos:

        #are we only looking for satellite QSOs?
        if SAT_ONLY:    
            prop_mode = qso.get('PROP_MODE', 'NONE')
            if prop_mode[:3] != 'SAT':
                continue
        
        #special case for VHF and up QSOs on a grid line or grid corner
        vucc_grids = qso.get('VUCC_GRIDS', 'NONE')
        if vucc_grids != 'NONE':
            lats = []
            lons = []

            #make a list of the individual grids
            grids = [grid.strip() for grid in vucc_grids.split(',') if grid.strip()]

            #loop through grids, add their lat and lons up
            for grid in grids:
                lat, lon = maidenhead_to_latlon(grid)
                lats.append(lat)
                lons.append(lon)
            
            #get the average lat and lon
            #this should be on the corner or on the grid line
            avg_lat = sum(lats) / len(lats)
            avg_lon = sum(lons) / len(lons)

            #plot it
            ax.plot(avg_lon, avg_lat, 'ro', markersize=1, transform=ccrs.PlateCarree())

            #we are done with this qso
            continue

        #make sure we have a valid grid. AA00 gets used as a placeholder when no grid is provided
        #not using "NONE" here because some logging apps will put in AA00 if no grid is specified
        grid_square = qso.get('GRIDSQUARE', 'AA00')
        if grid_square[:4] == 'AA00':
            continue

        #get the lat/lon from the grid
        lat, lon = maidenhead_to_latlon(grid_square)

        #plot it
        ax.plot(lon, lat, 'ro', markersize=1, transform=ccrs.PlateCarree())

def plot_qth(my_lat, my_lon, ax):
    #add a yellow star
    ax.plot(my_lon, my_lat, 'y*', markersize=10, transform=ccrs.PlateCarree())

def main():
    try:
        qsos, _ = adif_io.read_from_file(ADIF_FILE)
    except Exception as e:
        print(f"Error reading ADIF file: {e}")
        exit(1)

    #get the lat/lon for your location
    #hard coding it instead of looking at the log because sometimes the log may have multiple locations specified
    #not the most elegant way of doing things
    my_lat, my_lon = maidenhead_to_latlon(MY_GRID)

    #setup the plot
    plt.figure(figsize=(15, 10))
    ax = plt.axes(projection=ccrs.PlateCarree())

    #add the background image
    img = Image.open(BLUE_MARBLE_IMAGE)
    ax.imshow(img, origin='upper', extent=[-180, 180, -90, 90], transform=ccrs.PlateCarree())

    #add country borders and coast lines
    ax.add_feature(cfeature.BORDERS, edgecolor='gray', linewidth=0.5)
    ax.add_feature(cfeature.COASTLINE, edgecolor='white', linewidth=0.5)

    #grid lines and labels...salt to taste
    #ax.gridlines(draw_labels=False, linestyle='--', color='gray', alpha=0.5)
    #ax.xaxis.set_visible(False)
    #ax.yaxis.set_visible(False)
    #ax.set_frame_on(False)
    #ax.margins(0)

    #draw gridsqaures
    plot_grids(qsos, ax)

    #draw the path lines
    plot_paths(my_lat, my_lon, qsos, ax)

    #draw the qsos over the lines
    plot_qsos(qsos, ax)

    #plot your location on top
    plot_qth(my_lat, my_lon, ax)

    #save the map
    plt.savefig(OUTPUT_FILE, dpi=300, bbox_inches='tight', pad_inches=0)
 
    #close the plot
    plt.close()

    print(f"QSO map saved as {OUTPUT_FILE}")
    
if __name__ == "__main__":
    main()
